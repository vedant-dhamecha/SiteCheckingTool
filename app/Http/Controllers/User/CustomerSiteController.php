<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Jobs\RunCheck;
use App\Models\CustomerSite;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerSiteController extends Controller
{
    public function show(Request $request, CustomerSite $customerSite)
    {
        $data = $this->getMonitoringData($request, $customerSite, false);
        return view('User.SiteTracking.customer_sites.show', $data);
    }

    public function timeline(Request $request, CustomerSite $customerSite)
    {
        $data = $this->getMonitoringData($request, $customerSite, true);
        return view('User.SiteTracking.customer_sites.timeline', $data);
    }

    private function getMonitoringData(Request $request, CustomerSite $customerSite, bool $paginate)
    {
        $timeRange = $request->input('time_range', '1h');
        $startTime = $this->getStartTimeByTimeRange($timeRange);
        if ($request->has('start_time')) {
            $timeRange = null;
            $startTime = Carbon::parse($request->input('start_time'));
        }
        $endTime = Carbon::now();
        if ($request->has('end_time')) {
            $endTime = Carbon::parse($request->input('end_time'));
        }

        // Calculate uptime and downtime for the last 6 months
        $sixMonthsAgo = Carbon::now()->subMonths(6);
        $uptimeDowntimeLogs = DB::table('monitoring_logs')
            ->where('customer_site_id', $customerSite->id)
            ->whereBetween('created_at', [$sixMonthsAgo, $endTime])
            ->orderBy('created_at', 'asc')
            ->get(['response_time', 'created_at']);

        $totalUptime = 0;
        $totalDowntime = 0;
        $previousLog = null;

        foreach ($uptimeDowntimeLogs as $log) {
            if ($previousLog) {
                $duration = Carbon::parse($log->created_at)->diffInSeconds(Carbon::parse($previousLog->created_at));
                if ($previousLog->response_time <= $customerSite->down_threshold) {
                    $totalUptime += $duration;
                } else {
                    $totalDowntime += $duration;
                }
            }
            $previousLog = $log;
        }

        // Calculate duration from the last log entry to the current time if needed
        if ($previousLog) {
            $duration = Carbon::now()->diffInSeconds(Carbon::parse($previousLog->created_at));
            if ($previousLog->response_time <= $customerSite->down_threshold) {
                $totalUptime += $duration;
            } else {
                $totalDowntime += $duration;
            }
        }

        // Fetch logs for the selected time range
        $logQuery = DB::table('monitoring_logs')
            ->where('customer_site_id', $customerSite->id)
            ->whereBetween('created_at', [$startTime, $endTime]);

        if ($paginate) {
            $monitoringLogs = $logQuery->latest()->paginate(60);
        } else {
            $monitoringLogs = $logQuery->get(['response_time', 'created_at']);
        }

        $chartData = [];
        foreach ($monitoringLogs as $monitoringLog) {
            $chartData[] = ['x' => $monitoringLog->created_at, 'y' => $monitoringLog->response_time];
        }

        return compact('customerSite', 'monitoringLogs', 'chartData', 'startTime', 'endTime', 'timeRange', 'totalUptime', 'totalDowntime');
    }

    private function getStartTimeByTimeRange(string $timeRange): Carbon
    {
        switch ($timeRange) {
            case '6h': return Carbon::now()->subHours(6);
            case '24h': return Carbon::now()->subHours(24);
            case '7d': return Carbon::now()->subDays(7);
            case '14d': return Carbon::now()->subDays(14);
            case '30d': return Carbon::now()->subDays(30);
            case '3Mo': return Carbon::now()->subMonths(3);
            case '6Mo': return Carbon::now()->subMonths(6);
            default: return Carbon::now()->subHours(1);
        }
    }

    public function checkNow(Request $request, CustomerSite $customerSite)
    {
        RunCheck::dispatch($customerSite);
        return back();
    }
}

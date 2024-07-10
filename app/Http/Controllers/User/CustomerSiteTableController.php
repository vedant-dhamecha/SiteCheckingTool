<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CustomerSite;
use App\Models\MonitoringLog;
use App\Models\Vendor;
use Illuminate\Http\Request;

class CustomerSiteTableController extends Controller
{
    public function CustomerSiteList(Request $request)
    {
        $userId = auth()->id();

        $customersite = CustomerSite::select('customer_sites.id', 'customer_sites.name', 'customer_sites.url', 'vendors.name as vendor_name')
            ->join('vendors', 'customer_sites.vendor_id', '=', 'vendors.id')
            ->where('customer_sites.owner_id', $userId)
            ->get();

        return datatables()->of($customersite)
            ->addColumn('action', function ($customersite) {
                $view_link = '<a href="' . route('customer_sites.show', [$customersite]) . '" data-toggle="tooltip" data-original-title="View" class="text-blue-500"><i class="fa-solid fa-eye mr-2"></i></a>';
                $edit_link = '<a href="javascript:void(0)" data-toggle="tooltip" onClick="editCustomersiteFunc(' . $customersite->id . ')" data-original-title="Edit" class="text-yellow-500"><i class="fa-solid fa-pen-to-square mr-2"></i></a>';
                $delete_link = '<a href="javascript:void(0)" onClick="deleteCustomersiteFunc(' . $customersite->id . ')" data-toggle="tooltip" data-original-title="Delete" class="text-red-500"><i class="fa-solid fa-trash mr-2"></i></a>';
                return $view_link . '' . $edit_link . '' . $delete_link;
            })
            ->make(true);
    }

    public function index()
    {
        $vendors = Vendor::all();
        return view('User.SiteTracking.Customersite.index', compact('vendors'));
    }
    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'name' => 'required',
            'vendor_id' => 'required',
            'url' => 'required',
            'priority' => 'required',
            'notify_user_interval' => 'required',
            'warning_threshold' => 'required',
            'down_threshold' => 'required',
        ];
        $request->validate($rules);
        $userId = auth()->id();
        $customersiteData = [
            'name' => $request->name,
            'vendor_id' => $request->vendor_id,
            'url' => $request->url,
            'priority' => $request->priority,
            'notify_user_interval' => $request->notify_user_interval,
            'warning_threshold' => $request->warning_threshold,
            'down_threshold' => $request->down_threshold,
            'owner_id' => $userId,
        ];

        CustomerSite::updateOrCreate(['id' => $request->id], $customersiteData);
        return response()->json(['success' => 'Customer Site saved successfully.']);
    }

    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $customersite  = CustomerSite::where($where)->first();

        return Response()->json($customersite);
    }
    public function destroy(Request $request)
    {
        $customersiteId = $request->id;

        // Delete associated monitoring_logs records
        MonitoringLog::where('customer_site_id', $customersiteId)->delete();

        // Delete the CustomerSite record
        $customersite = CustomerSite::where('id', $customersiteId)->delete();

        return response()->json(['success' => 'Customer Site deleted successfully.']);
    }
    public function deleteSelected(Request $request)
    {
        $ids = $request->input('ids');

        // Iterate over each selected customer site ID
        foreach ($ids as $customerId) {
            // Delete monitoring logs associated with the customer site
            MonitoringLog::where('customer_site_id', $customerId)->delete();

            // Delete the customer site
            CustomerSite::where('id', $customerId)->delete();
        }

        return response()->json(['success' => true]);
    }
}

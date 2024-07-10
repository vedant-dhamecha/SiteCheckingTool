@extends('User.SiteTracking.layouts.customer_site')

@section('customer_site_content')
    <div class="pt-2" style="overflow-y: auto; max-height: 430px;">
        <table class="table table-sm table-responsive-sm table-hover" style="overflow-x: auto;">
            <thead>
                <tr>
                    <th class="text-center text-white">{{ __('app.table_no') }}</th>
                    <th class="text-center text-white">{{ __('app.created_at') }}</th>
                    <th class="text-center text-white">{{ __('monitoring_log.status_code') }}</th>
                    <th class="text-center text-white">{{ __('monitoring_log.response_time') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($monitoringLogs as $key => $monitoringLog)
                    <tr>
                        <td class="text-center text-white">{{ $monitoringLogs->firstItem() + $key }}</td>
                        <td class="text-center text-white">{{ $monitoringLog->created_at }}</td>
                        @if ($monitoringLog->status_code == 200)
                            <td class="text-center text-white"> {{ $monitoringLog->status_code }}<div
                                    class="btn btn-sm bg-success ml-2">OK</div>
                            </td>
                        @else
                            <td class="text-center text-white">{{ $monitoringLog->status_code }}<div
                                    class="btn btn-sm bg-red-500 ml-2">Error</div>
                            </td>
                        @endif
                        <td class="text-center text-white">{{ number_format($monitoringLog->response_time, 0) }}
                            {{ __('time.miliseconds') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $monitoringLogs->appends(Request::except('page'))->links() }}
    </div>
@endsection

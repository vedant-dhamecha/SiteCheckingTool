@extends('User.SiteTracking.layouts.app')

@section('title', __('customer_site.detail'))

@section('content')
    <div class="row p-3">
        <div class="col-md-4 order-2 order-md-1">
            <div class="card p-2">
                <div class="card-header">
                    <div class="float-end">
                        {{-- <form action="{{ route('customer_sites.check_now', $customerSite->id) }}" method="get">
                            <button type="submit" class="btn btn-success" id="check_now_{{ $customerSite->id }}">
                                {{ __('customer_site.check_now') }}
                            </button>
                        </form> --}}
                    </div>
                    <h2 class="text-3xl font-semibold text-white">{{ __('customer_site.customer_site') }}</h2>
                </div>
                <div class="card-body">
                    <table class="table table-sm bg-white">
                        <tbody>
                            <tr>
                                <td class="text-white">{{ __('customer_site.name') }}</td>
                                <td class="text-white">{{ $customerSite->name }}</td>
                            </tr>
                            <tr>
                                <td class="text-white">{{ __('customer_site.url') }}</td>
                                <td><a target="_blank" class="text-blue-400"
                                        href="{{ $customerSite->url }}">{{ $customerSite->url }}</a></td>
                            </tr>
                            <tr>
                                <td class="text-white">{{ __('vendor.vendor') }}</td>
                                <td class="text-white">{{ $customerSite->vendor->name }}</td>
                            </tr>
                            <tr>
                                <td class="text-white">{{ __('app.status') }}</td>
                                <td class="text-white">{{ $customerSite->is_active }}</td>
                            </tr>
                            <tr>
                                <td class="text-white">{{ __('customer_site.check_interval') }}</td>
                                <td class="text-white">
                                    {{ __('time.every') }}
                                    {{ $customerSite->check_interval }}
                                    {{ trans_choice('time.minutes', $customerSite->check_interval) }}
                                </td class="text-white">
                            </tr>
                            <tr>
                                <td class="text-white">{{ __('customer_site.priority_code') }}</td>
                                <td class="text-white">{{ $customerSite->priority_code }}</td>
                            </tr>
                            <tr>
                                <td class="text-white">{{ __('customer_site.warning_threshold') }}</td>
                                <td class="text-white">{{ $customerSite->warning_threshold }} {{ __('time.miliseconds') }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-white">{{ __('customer_site.down_threshold') }}</td>
                                <td class="text-white">{{ $customerSite->down_threshold }} {{ __('time.miliseconds') }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-white">{{ __('customer_site.notify_user_interval') }}</td>
                                <td class="text-white">
                                    {{ __('time.every') }}
                                    {{ $customerSite->notify_user_interval }}
                                    {{ trans_choice('time.minutes', $customerSite->notify_user_interval) }}
                                </td class="text-white">
                            </tr>
                            <tr>
                                <td class="text-white">{{ __('customer_site.last_check_at') }}</td>
                                <td class="text-white">{{ optional($customerSite->last_check_at)->diffForHumans() }}</td>
                            </tr>
                            <tr>
                                <td class="text-white">{{ __('customer_site.last_notify_user_at') }}</td>
                                <td class="text-white">{{ optional($customerSite->last_notify_user_at)->diffForHumans() }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-white">{{ __('app.created_at') }}</td>
                                <td class="text-white">{{ $customerSite->created_at }}</td>
                            </tr>
                            <tr>
                                <td class="text-white">{{ __('app.updated_at') }}</td>
                                <td class="text-white">{{ $customerSite->updated_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer mt-5">
                    {{-- @can('update', $customerSite)
                        <a href="{{ route('customer_sites.edit', $customerSite) }}" class="btn btn-warning float-right"
                            id="edit-customer_site-{{ $customerSite->id }}">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    @endcan --}}
                    <a href="{{ route('home') }}" class="btn btn-primary float-left">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Dashboard
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-8 order-1 order-md-2 bg-gray-900 p-5">
            <div class="py-4 py-md-0 clearfix">
                <div class="btn-group mb-3" role="group">
                    {{ link_to_route(Route::currentRouteName(), '1h', [$customerSite, 'time_range' => '1h'], ['class' => 'px-2.5 btn btn-outline-primary' . ($timeRange == '1h' ? ' active' : '')]) }}
                    {{ link_to_route(Route::currentRouteName(), '6h', [$customerSite, 'time_range' => '6h'], ['class' => 'px-2.5 btn btn-outline-primary' . ($timeRange == '6h' ? ' active' : '')]) }}
                    {{ link_to_route(Route::currentRouteName(), '24h', [$customerSite, 'time_range' => '24h'], ['class' => 'px-2.5 btn btn-outline-primary' . ($timeRange == '24h' ? ' active' : '')]) }}
                    {{ link_to_route(Route::currentRouteName(), '7d', [$customerSite, 'time_range' => '7d'], ['class' => 'px-2.5 btn btn-outline-primary' . ($timeRange == '7d' ? ' active' : '')]) }}
                    {{ link_to_route(Route::currentRouteName(), '14d', [$customerSite, 'time_range' => '14d'], ['class' => 'px-2.5 btn btn-outline-primary' . ($timeRange == '14d' ? ' active' : '')]) }}
                    {{ link_to_route(Route::currentRouteName(), '30d', [$customerSite, 'time_range' => '30d'], ['class' => 'px-2.5 btn btn-outline-primary' . ($timeRange == '30d' ? ' active' : '')]) }}
                    {{ link_to_route(Route::currentRouteName(), '3Mo', [$customerSite, 'time_range' => '3Mo'], ['class' => 'px-2.5 btn btn-outline-primary' . ($timeRange == '3Mo' ? ' active' : '')]) }}
                    {{ link_to_route(Route::currentRouteName(), '6Mo', [$customerSite, 'time_range' => '6Mo'], ['class' => 'px-2.5 btn btn-outline-primary' . ($timeRange == '6Mo' ? ' active' : '')]) }}
                </div>
                <div class="float-end mt-5">
                    {{ Form::open(['method' => 'get', 'class' => 'row row-cols-lg-auto g-2 align-items-center']) }}
                    <div class="col">
                        {{ Form::text('start_time', $startTime->format('Y-m-d H:i'), ['class' => 'date_time_select form-control text-white', 'style' => 'width:150px']) }}
                    </div>
                    <div class="col">
                        {{ Form::text('end_time', $endTime->format('Y-m-d H:i'), ['class' => 'date_time_select form-control text-white', 'style' => 'width:150px']) }}
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-warning mr-1">View Report</button>
                        <a href="{{ route('customer_sites.show', $customerSite) }}" class="btn btn-secondary"><i
                                class="fa-solid fa-circle-notch mr-2"></i>Reset</a>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
            <ul class="nav nav-tabs text-white">
                <li class="nav-item">
                    {{ link_to_route('customer_sites.show', __('monitoring_log.graph'), [$customerSite->id] + request(['time_range', 'start_time', 'end_time']), ['class' => 'nav-link' . (in_array(Request::segment(3), [null]) ? 'active' : '')]) }}
                </li>
                <li class="nav-item">
                    {{ link_to_route('customer_sites.timeline', __('monitoring_log.monitoring_log'), [$customerSite->id] + request(['time_range', 'start_time', 'end_time']), ['class' => 'nav-link' . (in_array(Request::segment(3), ['timeline']) ? 'active' : '')]) }}
                </li>
            </ul>
            @yield('customer_site_content')
        </div>
    </div>
    <br>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ url('css/plugins/jquery.datetimepicker.css') }}">
@endpush

@push('scripts')
    <script src="{{ url('js/jquery.min.js') }}"></script>
    <script src="{{ url('js/plugins/jquery.datetimepicker.js') }}"></script>
    <script>
        $('.date_time_select').datetimepicker({
            format: 'Y-m-d H:i',
            closeOnTimeSelect: true,
            scrollInput: false,
            dayOfWeekStart: 1
        });
    </script>
@endpush

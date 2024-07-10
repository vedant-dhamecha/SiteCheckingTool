@extends('User.SiteTracking.layouts.app')

@section('content')
    <div class="w-full bg-gray-800 p-8 shadow-lg text-white">
        <h1 class="text-4xl font-bold ml-6 mb-4">
            <i class="fa-solid fa-chart-simple mr-2 mb-4"></i>
            Site Tracking
        </h1>
        <div class="flex flex-wrap mt-8">
            <div class="w-full md:w-1/2 mb-4 md:mb-0">
                <h1 class="font-semibold ml-6">
                    @if (request('uptime_poll', 0))
                        <a href="{{ route('home', ['uptime_poll' => 0] + Request::except(['uptime_poll'])) }}"
                            class="bg-red-800 text-white py-3 px-3 rounded-sm hover:bg-red-700"><i
                                class="fa-solid fa-stop mr-2"></i>Stop
                            Monitoring</a>
                    @else
                        <a href="{{ route('home', ['uptime_poll' => 1] + Request::except(['uptime_poll'])) }}"
                            class="bg-blue-800 text-white py-3 px-3 rounded-sm hover:bg-blue-700 transition"><i
                                class="fa-solid fa-play mr-2"></i> Start
                            Monitoring</a>
                    @endif
                </h1>
            </div>
            <div class="w-full md:w-1/2">
                <div class="flex flex-wrap md:flex-nowrap justify-end space-y-2 md:space-y-0 md:space-x-2">
                    <form action="{{ route('home') }}" method="get" class="flex flex-wrap items-center">
                        <div class="flex mb-2 md:mb-0">
                            <input type="text" name="q" placeholder="{{ __('app.search') }}"
                                class="w-full md:w-60 p-1 border border-gray-300 rounded-md bg-gray-100 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 mr-2"
                                value="{{ request('q') }}">
                        </div>
                        <div class="flex mb-2 md:mb-0">
                            <select name="vendor_id"
                                class="p-1 border border-gray-300 rounded-md bg-gray-100 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 mr-4">
                                <option value="">{{ __('vendor.all') }}</option>
                                @foreach ($availableVendors as $vendorId => $vendorName)
                                    <option value="{{ $vendorId }}"
                                        {{ request('vendor_id') == $vendorId ? 'selected' : '' }}>
                                        {{ $vendorName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex mb-2 md:mb-0">
                            <input type="hidden" name="uptime_poll" value="{{ request('uptime_poll', 0) }}">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 mr-2">
                                <i class="fa-solid fa-magnifying-glass mr-2"></i>
                                {{ __('app.search') }}
                            </button>
                            <a href="{{ route('home', Request::only(['uptime_poll'])) }}"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded">
                                <i class="fa-solid fa-circle-notch mr-2"></i>
                                {{ __('app.reset') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap mt-8">
            @foreach ($customerSites as $customerSite)
                <a href="{{ route('customer_sites.show', [$customerSite]) }}"
                    class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-1 mb-2 text-decoration-none">
                    <div
                        class="bg-gray-900 border border-gray-800 rounded-md shadow-md hover:shadow-lg transition transform hover:scale-105">
                        <div class="p-3">
                            <div class="flex items-center justify-between">
                                <div class="w-1/2">
                                    <div class="text-white font-semibold">{{ $customerSite->name }}</div>
                                    <span
                                        class="bg-gray-700 text-white text-xs rounded px-1">{{ $customerSite->vendor->name }}</span>
                                </div>
                                <div class="w-1/2 text-right">
                                    <div class="text-sm text-gray-400"
                                        title="{{ __('customer_sites.check_interval') }}: {{ __('time.every') }} {{ $customerSite->check_interval }} {{ trans_choice('time.minutes', $customerSite->check_interval) }}">
                                        {{ $customerSite->check_interval }}
                                        {{ trans_choice('time.minutes', $customerSite->check_interval) }}
                                    </div>
                                    @livewire('uptime-badge', [
                                        'customerSite' => $customerSite,
                                        'uptimePoll' => request('uptime_poll', 0),
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .log_indicator {
            padding: 4px 1px;
            cursor: pointer;
            margin-left: -0.4px;
        }
    </style>
@endpush

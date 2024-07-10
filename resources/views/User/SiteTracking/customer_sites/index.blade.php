@extends('layouts.app')

{{-- @section('title', __('customer_site.list')) --}}

@section('content')
    <div class="mb-3">
        <div class="float-end">
            @can('create', new App\Models\CustomerSite())
                <a href="{{ route('customer_sites.create') }}"
                    class="bg-green-600 hover:bg-green-500 text-white py-3 px-4 rounded-md mr-10">
                    <i class="fa-solid fa-plus mr-2"></i>{{ __('customer_site.create') }}
                </a>
            @endcan
        </div>
        <h2 class="page-title text-3xl font-bold ml-12 text-white">{{ __('customer_site.list') }} <small class="text-sm">(
                {{ __('app.total') }} : {{ $customerSites->total() }}
                {{ __('customer_site.customer_site') }} )</small></h2>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card bg-gray-800 text-white ml-10 mr-10">
                <div class="card-header d-flex justify-content-between align-items-center">
                    {{ Form::open(['method' => 'get', 'class' => 'row g-3 align-items-center']) }}
                    <div class="col-12 col-lg-4 mt-4">
                        <input type="text" name="q" value="{{ request('q') }}"
                            class="w-full p-2 border border-gray-700 rounded-md bg-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="{{ __('customer_site.search') }}">
                    </div>
                    <div class="col-12 col-lg-8 d-flex justify-content-end align-items-center">
                        <button type="submit"
                            class="mr-2 mt-2 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-500 font-medium rounded-lg text-sm px-4 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <i class="fa-solid fa-magnifying-glass mr-2"></i>{{ __('app.search') }}
                        </button>
                        <a href="{{ route('customer_sites.index') }}"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded-lg py-2 px-4 mt-2.5 text-center">
                            <i class="fa-solid fa-circle-notch  mr-2"></i>{{ __('app.reset') }}
                        </a>
                    </div>
                    {{ Form::close() }}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-hover">
                            <thead class="bg-white">
                                <tr>
                                    <th class="text-center text-white">{{ __('app.table_no') }}</th>
                                    <th class="text-white">{{ __('customer_site.name') }}</th>
                                    <th class="text-white">{{ __('customer_site.url') }}</th>
                                    <th class="text-white">{{ __('vendor.vendor') }}</th>
                                    <th class="text-white text-center">{{ __('app.status') }}</th>
                                    <th class="text-center text-white">{{ __('app.action') }}</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($customerSites as $key => $customerSite)
                                    <tr>
                                        <td class="text-white">{{ $customerSites->firstItem() + $key }}</td>
                                        <td class="text-white">{{ $customerSite->name }}</td>
                                        <td class="text-white"><a target="_blank" href="{{ $customerSite->url }}">{{ $customerSite->url }}</a></td>
                                        <td class="text-white">{{ $customerSite->vendor->name }}</td>
                                        <td class="text-center text-white">{{ $customerSite->is_active }}</td>
                                        <td class="text-white text-center">
                                            @can('view', $customerSite)
                                                <a href="{{ route('customer_sites.show', [$customerSite]) }}"
                                                    id="show-customer_site-{{ $customerSite->id }}"
                                                    class="text-blue-500 hover:text-blue-600">
                                                    <i class="fa-solid fa-eye mr-2"></i>
                                                </a>
                                            @endcan
                                            @can('update', $customerSite)
                                                <a href="{{ route('customer_sites.edit', [$customerSite]) }}"
                                                    id="edit-customer_site-{{ $customerSite->id }}"
                                                    class="text-yellow-500">
                                                    <i class="fa-solid fa-pen-to-square mr-2"></i>
                                                </a>
                                            @endcan
                                            @can('delete', $customerSite)
                                                <a href="{{ route('customer_sites.edit', [$customerSite, 'action' => 'delete']) }}"
                                                    class="text-red-500"
                                                    id="del-customer_site-{{ $customerSite->id }}">
                                                    <i class="fa-solid fa-trash mr-2"></i>
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-body">{{ $customerSites->appends(Request::except('page'))->render() }}</div>
            </div>
        </div>
    </div>
@endsection

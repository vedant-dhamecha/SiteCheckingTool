<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="referrer" content="always">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
        @include('admin.layouts.sidebar')
        <div class="flex-1 flex flex-col overflow-hidden">
            @include('admin.layouts.header')
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container mx-auto px-6 py-8">
                    @yield('content')
                </div>
            </main>
            @include('admin.layouts.footer')
        </div>
    </div>
</body>

</html>

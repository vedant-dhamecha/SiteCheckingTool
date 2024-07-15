@extends('admin.layouts.app')
@section('title', 'DevSync | Site Settings')
@section('content')
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Custom CSS for modal animation */
        .modal.fade .modal-dialog {
            transition: transform 0.3s ease-out;
            transform: translateY(-100%);
        }

        .modal.fade.show .modal-dialog {
            transform: translateY(0);
        }

        /* Modal position and overlay */
        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1050;
            /* Ensure higher than other content */
        }

        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Semi-transparent overlay */
            z-index: 1040;
            /* Below modal but above other content */
        }
    </style>
    <!-- sweet alert ttitle color -->
    <style>
        .custom-toast .swal2-title {
            color: #ffffff !important;
        }
    </style>

    <div class="bg-white w-full flex flex-col gap-5 px-3 md:px-16 lg:px-28 md:flex-row text-[#161931]">
        <aside class="hidden py-4 md:w-1/3 lg:w-1/4 md:block">
            <div class="sticky flex flex-col gap-2 p-4 text-sm border-r border-indigo-100 top-12">
                <h2 class="pl-3 mb-4 text-2xl font-semibold">Settings</h2>
                <a href="{{ route('admin.profile') }}"
                    class="flex items-center px-3 py-2.5 font-semibold hover:text-indigo-900 hover:border hover:rounded-full  ">
                    <i class="fa-solid fa-user px-2"></i>
                    Admin Profile
                </a>
                <a href="{{ route('admin.password') }}"
                    class="flex items-center px-3 py-2.5 font-semibold hover:text-indigo-900 hover:border hover:rounded-full  ">
                    <i class="fa-solid fa-key px-2"></i>
                    Change Password
                </a>
                <a href="{{ route('admin.sitesetting') }}"
                    class="flex items-center px-3 py-2.5 font-bold bg-white  text-indigo-900 border rounded-full">
                    <i class="fa-solid fa-gear mr-2 ml-2"></i>
                    Site Settings
                </a>
                {{-- <a href="#"
                    class="flex items-center px-3 py-2.5 font-semibold  hover:text-indigo-900 hover:border hover:rounded-full">
                    Site Settings
                </a> --}}
            </div>
        </aside>

    </div>



@endsection

@extends('admin.layouts.app')
@section('title', 'DevSync | Change Password')
@section('content')
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Custom styles for Parsley validation errors */
        .parsley-errors-list {
            color: #ff0000;
            /* Custom color */
            font-size: 14px;
            /* Custom size */
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
                    <i class="fa-solid fa-user px-2 mr-2"></i>
                    Admin Profile
                </a>
                <a href="{{ route('admin.password') }}"
                    class="flex items-center px-3 py-2.5 font-bold bg-white  text-indigo-900 border rounded-full">
                    <i class="fa-solid fa-key px-2 mr-2"></i>
                    Change Password
                </a>
                <a href="{{ route('admin.sitesetting') }}"
                    class="flex items-center px-3 py-2.5 font-semibold hover:text-indigo-900 hover:border hover:rounded-full">
                    <i class="fa-solid fa-gear mr-2 ml-2"></i>
                    Site Settings
                </a>
            </div>
        </aside>
        <main class="w-full min-h-screen py-1 md:w-2/3 lg:w-3/4">
            <div class="p-2 md:p-4">
                <div class="w-full px-6 pb-8 mt-8 sm:max-w-xl sm:rounded-lg">
                    <h2 class="text-2xl font-bold sm:text-xl">Change Password</h2>
                    <div class="grid max-w-2xl mx-auto mt-8 gap-y-6">
                        <form method="POST" action="{{ route('admin.password.update') }}" name="formChangePass"
                            id="formChangePass" data-parsley-validate>
                            @csrf
                            <div class="grid grid-cols-1 gap-y-6">
                                <div>
                                    <label for="current_password"
                                        class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Current
                                        Password<span class="text-red-500">*</span></label>
                                    <input id="current_password" type="password" name="current_password"
                                        autocomplete="current-password" placeholder="Current password" required
                                        data-parsley-trigger="change" data-parsley-required="true"
                                        data-parsley-required-message="Current Password is required."
                                        class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5">
                                    @if ($errors->has('current_password'))
                                        <p style="color:red;">{{ $errors->first('current_password') }}</p>
                                    @endif
                                </div>
                                <div>
                                    <label for="new_password"
                                        class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">New
                                        Password<span class="text-red-500">*</span></label>
                                    <input id="new_password" type="password" name="new_password"
                                        autocomplete="current-password" placeholder="New password" required
                                        data-parsley-trigger="change" data-parsley-minlength="8"
                                        data-parsley-minlength-message="New Password must be at least 8 characters"
                                        data-parsley-required="true"
                                        data-parsley-required-message="New Password is required."
                                        class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5">
                                    @if ($errors->has('new_password'))
                                        <p style="color:red;">{{ $errors->first('new_password') }}</p>
                                    @endif
                                </div>
                                <div>
                                    <label for="new_confirm_password"
                                        class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Confirm
                                        Password<span class="text-red-500">*</span></label>
                                    <input id="new_confirm_password" type="password" name="new_confirm_password"
                                        autocomplete="current-password" placeholder="Confirm password" required
                                        data-parsley-trigger="change" data-parsley-equalto="#new_password"
                                        data-parsley-equalto-message="Passwords do not match" data-parsley-required="true"
                                        data-parsley-required-message="Confirm Password is required."
                                        class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5">
                                    @if ($errors->has('new_confirm_password'))
                                        <p style="color:red;">{{ $errors->first('new_confirm_password') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex justify-end mt-6">
                                <button type="submit"
                                    class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        $(document).ready(function() {
            $('#formChangePass').parsley({
                errorsWrapper: '<div class="text-red-600 text-sm"></div>',
                errorTemplate: '<span></span>'
            });
        });
    </script>
    <script>
        $('#formChangePass').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.password.update') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function() {
                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        title: 'Password updated successfully',
                        background: '#28a745', // Green background color
                        iconColor: '#ffffff', // White icon color
                        animation: false,
                        position: 'bottom-right',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        customClass: {
                            popup: 'custom-toast'
                        },
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                },
                error: function(data) {
                    // console.log(data);
                    // Display error message
                    // alert('An error occurred while processing your request. Please try again.');
                }
            });
        });
    </script>
@endsection

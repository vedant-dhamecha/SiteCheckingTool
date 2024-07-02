@extends('admin.layouts.app')
@section('title', 'DevSync | Admin Profile')
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

    <div class="bg-white w-full flex flex-col gap-5 px-3 md:px-16 lg:px-28 md:flex-row text-[#161931]">
        <aside class="hidden py-4 md:w-1/3 lg:w-1/4 md:block">
            <div class="sticky flex flex-col gap-2 p-4 text-sm border-r border-indigo-100 top-12">
                <h2 class="pl-3 mb-4 text-2xl font-semibold">Settings</h2>
                <a href="{{ route('admin.profile') }}"
                    class="flex items-center px-3 py-2.5 font-bold bg-white  text-indigo-900 border rounded-full">
                    <i class="fa-solid fa-user px-2"></i>
                    Admin Profile
                </a>
                <a href="{{ route('admin.password') }}"
                    class="flex items-center px-3 py-2.5 font-semibold hover:text-indigo-900 hover:border hover:rounded-full  ">
                    <i class="fa-solid fa-lock px-2"></i>
                    Change Password
                </a>
                {{-- <a href="#"
                    class="flex items-center px-3 py-2.5 font-semibold  hover:text-indigo-900 hover:border hover:rounded-full">
                    Site Settings
                </a> --}}
            </div>
        </aside>
        <main class="w-full min-h-screen py-1 md:w-2/3 lg:w-3/4">
            <div class="p-2 md:p-4">
                <div class="w-full px-6 pb-8 mt-8 sm:max-w-xl sm:rounded-lg">
                    <h2 class="pl-6 text-2xl font-bold sm:text-xl">Admin Profile</h2>
                    <div class="grid max-w-2xl mx-auto mt-8">
                        <div class="flex flex-col items-center space-y-5 sm:flex-row sm:space-y-0">
                            @if (!auth()->user()->profile)
                                <img class="object-cover w-40 h-40 p-1 rounded-full ring-2 ring-indigo-300 dark:ring-indigo-500"
                                    src="{{ asset('images/user.jpg') }}" alt="Default user avatar">
                            @else
                                <img class="object-cover w-40 h-40 p-1 rounded-full ring-2 ring-indigo-300 dark:ring-indigo-500"
                                    src="{{ asset('storage/' . auth()->user()->profile) }}" alt="Bordered avatar">
                            @endif
                            <div class="flex flex-col space-y-5 sm:ml-8">
                                <button type="button"
                                    class="py-3.5 px-7 text-base font-medium text-indigo-100 focus:outline-none bg-[#202142] rounded-lg border border-indigo-200 hover:bg-indigo-900 focus:z-10 focus:ring-4 focus:ring-indigo-200 "
                                    id="changePictureBtn">
                                    Change picture
                                </button>
                                <form id="deleteProfileForm" action="{{ route('admin.profilepicture.delete') }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="py-3.5 px-7 text-base font-medium text-indigo-900 focus:outline-none bg-white rounded-lg border border-indigo-200 hover:bg-indigo-100 hover:text-[#202142] focus:z-10 focus:ring-4 focus:ring-indigo-200 ">
                                        Delete picture
                                    </button>
                                </form>

                            </div>
                        </div>
                        <form action="{{ route('admin.profile.update') }}" novalidate="" id="profileForm"
                            enctype="multipart/form-data" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ auth()->user()->id }}">
                            <div class="items-center mt-8 sm:mt-14 text-[#202142]">
                                <div
                                    class="flex flex-col items-center w-full mb-2 space-x-0 space-y-2 sm:flex-row sm:space-x-4 sm:space-y-0 sm:mb-6">
                                    <div class="w-full">
                                        <label for="first_name"
                                            class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">
                                            First Name<span class="text-red-500">*</span></label>
                                        <input type="text" id="first_name"
                                            class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                            name="first_name" placeholder="First Name"
                                            value="{{ auth()->user()->first_name }}" data-parsley-required="true"
                                            data-parsley-required-message="First name is required."
                                            data-parsley-pattern="/^[A-Za-z]+$/"
                                            data-parsley-pattern-message="First name must contain only letters." required>
                                    </div>
                                    <div class="w-full">
                                        <label for="last_name"
                                            class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">
                                            Last Name<span class="text-red-500">*</span></label>
                                        <input type="text" id="last_name"
                                            class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                            name="last_name" placeholder="Last Name" value="{{ auth()->user()->last_name }}"
                                            data-parsley-required="true"
                                            data-parsley-required-message="Last name is required."
                                            data-parsley-pattern="/^[A-Za-z]+$/"
                                            data-parsley-pattern-message="Last name must contain only letters." required>
                                    </div>
                                </div>
                                <div class="mb-2 sm:mb-6">
                                    <label for="email"
                                        class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">
                                        Email Address<span class="text-red-500">*</span></label>
                                    <input type="email" readonly="" id="email"
                                        class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                        placeholder="" value="{{ auth()->user()->email }}" required>
                                </div>
                                <div
                                    class="flex flex-col items-center w-full mb-2 space-x-0 space-y-2 sm:flex-row sm:space-x-4 sm:space-y-0 sm:mb-6">
                                    <div class="w-full">
                                        <label for="home_phone"
                                            class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">
                                            Home Phone<span class="text-red-500">*</span></label>
                                        <input type="text" id="home_phone"
                                            class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                            name="home_phone" placeholder="Home Phone"
                                            value="{{ auth()->user()->home_phone }}" data-parsley-maxlength="10"
                                            data-parsley-pattern="^\d{10}$"
                                            data-parsley-pattern-message="Invalid phone number. Please enter a 10-digit number."
                                            data-parsley-required="true"
                                            data-parsley-required-message="Phone number is required." required>
                                    </div>
                                    <div class="w-full">
                                        <label for="cell_phone"
                                            class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">
                                            Cell Phone</label>
                                        <input type="text" id="cell_phone"
                                            class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                            name="cell_phone" placeholder="Cell Phone"
                                            value="{{ auth()->user()->cell_phone }}" data-parsley-pattern="^\d{10}$"
                                            data-parsley-pattern-message="Invalid phone number. Please enter a 10-digit number.">
                                    </div>
                                </div>
                                <div class="mb-2 sm:mb-6">
                                    <label for="address"
                                        class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">
                                        Address<span class="text-red-500">*</span></label>
                                    <input type="text" id="address"
                                        class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                        name="address" placeholder="Vadodara" value="{{ auth()->user()->address }}"
                                        data-parsley-pattern="^[a-zA-Z0-9\s\.,&#39;-]*$"
                                        data-parsley-pattern-message="Please enter valid address"
                                        data-parsley-required="true" data-parsley-required-message="Address is required."
                                        required>
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit"
                                        class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal for image cropping -->
    <div class="modal fade" id="pic-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-container bg-white md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left">

                <div class="pt-4 pb-6">
                    <div class="flex justify-between">
                        <p class="text-xl font-bold px-12">Crop &amp; Upload</p>
                        <div class="flex justify-end mr-3">
                            <button type="button" class="btn-close mr-3" data-bs-dismiss="modal" aria-label="Close" style="font-size: 1.5rem;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="modal-body formControl-white modal-buildingMatrix">
                    <div class="row g-lg-4 g-3">
                        <div class="col-md-12 text-center">
                            <div class="col-md-12 text-center">
                                <div id="upload-demo" style="width: 450px; height: 400px; margin: auto;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex justify-center">
                    <button class="px-4 bg-purple-700 py-2 ml-3 rounded-lg text-white hover:bg-purple-500 upload-result">Save</button>
                </div>
            </div>
            </div>
        </div>
    </div>

    <input type="file" id="profile" style="display: none;" accept="image/*">
    <script>
        $(document).ready(function() {
            // Initialize Parsley validation
            $('#profileForm').parsley({
                errorsWrapper: '<div class="text-red-600 text-sm"></div>',
                errorTemplate: '<span></span>'
            });

            // Initialize Croppie for image cropping
            var $uploadCrop = $('#upload-demo').croppie({
                enableExif: true,
                viewport: {
                    width: 300,
                    height: 300,
                    type: 'circle',
                },
                boundary: {
                    width: 350,
                    height: 350
                },
            });

            // Show modal when change picture button is clicked
            $('#changePictureBtn').on('click', function() {
                $('#profile').click();
            });

            // Handle image selection and show modal
            $('#profile').on('change', function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $uploadCrop.croppie('bind', {
                        url: e.target.result,
                    }).then(function() {
                        $('#pic-modal').modal({
                            backdrop: 'static', // Prevent closing by clicking outside
                            keyboard: false // Prevent closing by pressing escape key
                        });
                        $('.cr-slider').attr('min', 0.2).attr('max', 1.0);
                    });
                }
                reader.readAsDataURL(this.files[0]);
            });

            // Handle crop and upload
            $('.upload-result').on('click', function(ev) {
                $uploadCrop.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function(resp) {
                    $.ajax({
                        url: "{{ route('admin.profilepicture.update') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "image": resp
                        },
                        success: function(data) {
                            localStorage.setItem('showSweetAlert', 'true');
                            window.location.reload();
                        }
                    });
                });
            });

            // Check and show SweetAlert on successful update
            if (localStorage.getItem('showSweetAlert') === 'true') {
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    title: 'Profile Picture Updated Successfully',
                    animation: false,
                    position: 'bottom-right',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    }
                });

                localStorage.removeItem('showSweetAlert');
            }
        });
    </script>

@endsection

@extends('admin.layouts.app')
@section('title', 'DevSync | Admin Dashboard')
@section('content')

    <main class="container mx-auto p-2">
        <div class="content">
            <section class="main-header flex justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-800"><i class="fa-solid fa-users mr-5 ml-8"></i>Manage Users</h1>
                <div class="flex justify-end">
                    <a href="javascript:void(0)"
                        class="clear_db_filters px-6 py-3 bg-gray-600 rounded-md text-white font-medium tracking-wide hover:bg-gray-500 ml-auto mr-3">
                        <i class="fa-solid fa-filter-circle-xmark mr-3"></i>
                        <span class="font-plus-jakarta-sans">Clear Filter</span>
                    </a>
                    <button
                        class="px-6 py-3 bg-blue-600 rounded-md text-white font-medium tracking-wide hover:bg-blue-500 ml-auto"
                        onClick="addUser()">
                        <i class="fa-solid fa-user-plus mr-3"></i>
                        <span class="font-plus-jakarta-sans">Add New</span>
                    </button>
                    <button
                        class="px-6 py-3 bg-red-600 rounded-md text-white font-medium tracking-wide hover:bg-red-500 ml-3">
                        <i class="fa-solid fa-trash mr-3"></i>
                        <span class="font-plus-jakarta-sans">Delete Selected</span>
                    </button>
                </div>
            </section>

            <div class="card bg-gray-300 p-6 rounded-md shadow-md">
                <table id="users-table" class="min-w-full leading-normal datatable-th">
                    <thead>
                        <tr>
                            <th class="py-3 px-5 bg-indigo-800 font-medium uppercase text-sm text-gray-100">
                                <div class="flex items-center">
                                    <input type="checkbox"
                                        class="w-4 h-4 text-yellow-600 bg-gray-300 border-gray-300 rounded focus:ring-yellow-500 dark:focus:ring-yellow-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                </div>
                            </th>
                            <th class="py-3 px-5 bg-indigo-800 font-medium uppercase text-sm text-gray-100">
                                Profile</th>
                            <th class="py-3 px-5 bg-indigo-800 font-medium uppercase text-sm text-gray-100">
                                Name</th>
                            <th class="py-3 px-5 bg-indigo-800 font-medium uppercase text-sm text-gray-100">
                                Email</th>
                            <th class="py-3 px-5 bg-indigo-800 font-medium uppercase text-sm text-gray-100">
                                Role</th>
                            <th class="py-3 px-5 bg-indigo-800 font-medium uppercase text-sm text-gray-100">
                                Created At</th>
                            <th class="py-3 px-5 bg-indigo-800 font-medium uppercase text-sm text-gray-100">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- DataTable will populate this area -->
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden" id="user-modal"
        aria-hidden="true">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl transform transition-all duration-500 ease-out opacity-0 translate-y-[-50%]"
            id="modal-content">
            <div class="flex justify-between items-center p-5 border-b border-gray-200 mt-2 ">
                <h4 class="text-lg font-semibold text-gray-800" id="UserModal"><i class="fa-solid fa-user-plus mr-2"></i>
                    Add New User</h4>
                <button type="button" class="text-gray-400 hover:text-gray-600 focus:outline-none" onClick="closeModal()"
                    aria-label="Close">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="p-4 space-y-4">
                <form action="javascript:void(0)" id="UserForm" name="UserForm" class="space-y-4" novalidate=""
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div
                        class="flex flex-col items-center w-full mb-2 space-x-0 space-y-2 sm:flex-row sm:space-x-4 sm:space-y-0">
                        <div class="w-full">
                            <label for="first_name" class="block mb-1 text-sm font-medium text-indigo-900 dark:text-white">
                                First Name<span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="first_name" name="first_name" placeholder="First Name"
                                class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                data-parsley-required="true" data-parsley-required-message="Enter your first name."
                                data-parsley-pattern="/^[A-Z][a-z]*$/"
                                data-parsley-pattern-message="First letter must be capital."
                                data-parsley-pattern-message-class="text-red-500"
                                data-parsley-pattern-message="First name must contain only letters." required>
                        </div>
                        <div class="w-full">
                            <label for="last_name" class="block mb-1 text-sm font-medium text-indigo-900 dark:text-white">
                                Last Name<span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="last_name" name="last_name" placeholder="Last Name"
                                class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                data-parsley-required="true" data-parsley-required-message="Enter your last name."
                                data-parsley-pattern="/^[A-Z][a-z]*$/"
                                data-parsley-pattern-message="First letter must be capital."
                                data-parsley-pattern-message-class="text-red-500"
                                data-parsley-pattern-message="Last name must contain only letters." required>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:space-x-4">
                        <div class="w-full">
                            <label for="email" class="block mb-1 text-sm font-medium text-indigo-900 dark:text-white">
                                Email Address<span class="text-red-500">*</span>
                            </label>
                            <input type="email" id="email" name="email" placeholder="Email Address"
                                class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                data-parsley-type="email" data-parsley-required="true"
                                data-parsley-required-message="Enter your email address."
                                data-parsley-pattern="/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i"
                                data-parsley-pattern-message="Please enter a valid email address." required>
                        </div>
                        <div class="w-full">
                            <label for="role_id" class="block mb-1 text-sm font-medium text-indigo-900 dark:text-white">
                                Role<span class="text-red-500">*</span>
                            </label>
                            <select id="role_id" name="role_id"
                                class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                data-parsley-required="true" data-parsley-required-message="Select role.">
                                <option value="" class="text-gray-400">Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role['role_id'] }}"
                                        {{ old('role_id') == $role['role_id'] ? 'selected' : '' }}>{{ $role['role_name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div
                        class="flex flex-col items-center w-full mb-2 space-x-0 space-y-2 sm:flex-row sm:space-x-4 sm:space-y-0">
                        <div class="w-full">
                            <label for="password" class="block mb-1 text-sm font-medium text-indigo-900 dark:text-white">
                                Password<span class="text-red-500">*</span>
                            </label>
                            <input type="password" id="password" name="password" placeholder="Password"
                                class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                required data-parsley-minlength="8"
                                data-parsley-minlength-message="Password must be at least 8 characters."
                                data-parsley-required="true" data-parsley-required-message="Enter your password.">
                        </div>
                        <div class="w-full">
                            <label for="confirm_password"
                                class="block mb-1 text-sm font-medium text-indigo-900 dark:text-white">
                                Confirm Password<span class="text-red-500">*</span>
                            </label>
                            <input type="password" id="confirm_password" name="confirm_password"
                                placeholder="Confirm Password"
                                class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                required data-parsley-equalto="#password"
                                data-parsley-equalto-message="Password do not match." data-parsley-required="true"
                                data-parsley-required-message="Enter your confirm password.">
                        </div>
                    </div>
                    <div
                        class="flex flex-col items-center w-full mb-2 space-x-0 space-y-2 sm:flex-row sm:space-x-4 sm:space-y-0">
                        <div class="w-full">
                            <label for="home_phone"
                                class="block mb-1 text-sm font-medium text-indigo-900 dark:text-white">
                                Home Phone<span class="text-red-500">*</span>
                            </label>
                            <input type="tel" id="home_phone" name="home_phone" placeholder="Home Phone"
                                class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                pattern="[0-9]{10}" maxlength="10" data-parsley-maxlength="10"
                                data-parsley-maxlength-message="Home phone number must be 10 digits."
                                data-parsley-pattern-message="Home phone number must be 10 digit number."
                                data-parsley-required="true" data-parsley-required-message="Enter your home phone number."
                                required
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                onkeydown="return ( event.ctrlKey || event.altKey
                                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                                    || (95<event.keyCode && event.keyCode<106)
                                    || (event.keyCode==8 || event.keyCode==9
                                        || event.keyCode==37 || event.keyCode==39 || event.keyCode==46)
                                    )
                                    && event.keyCode!=110">
                        </div>
                        <div class="w-full">
                            <label for="cell_phone"
                                class="block mb-1 text-sm font-medium text-indigo-900 dark:text-white">
                                Cell Phone
                            </label>
                            <input type="tel" id="cell_phone" name="cell_phone" placeholder="Cell Phone"
                                class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5">
                        </div>
                    </div>
                    <div class="mb-2 sm:mb-4">
                        <label for="address" class="block mb-1 text-sm font-medium text-indigo-900 dark:text-white">
                            Address<span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="address" name="address" placeholder="Address"
                            class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                            required>
                    </div>
                    <div class="flex justify-end">
                        <button type="reset" id="btn-reset"
                            class="mr-2 mt-2 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                            Reset
                        </button>
                        <button type="submit"
                            class="text-white mt-2 bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <style>
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-50%);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-down {
            animation: fadeInDown 0.5s ease-out forwards;
        }
    </style>

    <script type="text/javascript">
        //datatable
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#users-table').DataTable({
                processing: false,
                serverSide: true,
                filter: true,
                ajax: "{{ route('admin.manage.users.list') }}",
                responsive: true,
                columns: [{
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, row) {
                            return '<input type="checkbox" class="w-4 h-4 text-yellow-600 bg-gray-300 border-gray-300 rounded focus:ring-yellow-500 dark:focus:ring-yellow-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" data-id="' +
                                data.id +
                                '">';
                        }
                    },
                    {
                        data: 'profile',
                        name: 'profile',
                        orderable: false,
                        render: function(data, type, full, row) {
                            var imagePath = data ? '/storage/' + data :
                                '{{ asset('images/user.jpg') }}';
                            return '<img class="object-cover w-10 h-10" src="' + imagePath +
                                '" alt="User avatar">';
                        }
                    },
                    {
                        data: 'name',
                        name: 'name',
                        orderable: false,
                    },
                    {
                        data: 'email',
                        name: 'email',
                        orderable: false,
                    },
                    {
                        data: 'role_name',
                        name: 'role_name',
                        orderable: false,
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        orderable: false,
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [],
                pagingType: 'simple_numbers',
                language: {
                    paginate: {
                        previous: '&lt;',
                        next: '&gt;'
                    }
                },
                initComplete: function() {
                    var api = this.api();
                    api.columns([2, 3]).every(function() {
                        var column = this;
                        var input = $(
                                '<input type="text" class="w-full mt-2 h-8 text-black pl-4 pr-4 rounded-md form-input focus:border-indigo-600 focus:ring-indigo-600 bg-white border border-gray-300" placeholder="Filter"/>'
                            )
                            .appendTo($(column.header()))
                            .on('input', function() {
                                shouldSort = false;
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val, true, false).draw();
                            });
                    });
                    api.columns([4]).every(function() {
                        var column = this;
                        var select = $(
                                '<select class="bg-gray-50 w-32 mt-2 h-8 text-black pl-4 pr-4 rounded-md form-input focus:border-indigo-600 focus:ring-indigo-600 bg-white border border-gray-300"><option value="">All</option></select>'
                            )
                            .appendTo($(column.header()))
                            .on('change', function() {
                                shouldSort = false;
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                if (val === '') {
                                    column.search('').draw();
                                } else {
                                    var regex = '^' + val + '$';
                                    column.search(regex, true, false).draw();
                                }
                            });
                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d +
                                '</option>');
                        });
                    });
                }
            });
        });
        //clear filter
        $(document).ready(function() {
            $('.clear_db_filters').click(function() {
                var table = $('#users-table')
                    .DataTable();
                table.search('').columns().search('').draw();
            });
        });
        //model
        function addUser() {
            const modal = document.getElementById('user-modal');
            const modalContent = document.getElementById('modal-content');
            $('#userModal').html("Add New User");
            modal.classList.remove('hidden');
            modalContent.classList.add('fade-in-down');
        }
        //model close
        function closeModal() {
            const modal = document.getElementById('user-modal');
            const modalContent = document.getElementById('modal-content');
            modal.classList.add('hidden');
            modalContent.classList.remove('fade-in-down');
        }
        //reset model form
        $(document).ready(function() {
            $('#btn-reset').click(function() {
                $('#UserForm').trigger("reset");
            });
        });
        //add user ajax
        $('#UserForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.manage.users.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    closeModal();
                    var oTable = $('#users-table').dataTable();
                    oTable.fnDraw(false);
                    $("#btn-save").html('Submit');
                    $("#btn-save").attr("disabled", false);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
        //parsley validation
        $('#UserForm').parsley({
            errorsWrapper: '<div class="text-red-600 text-sm"></div>',
            errorTemplate: '<span></span>'
        });
    </script>

@endsection

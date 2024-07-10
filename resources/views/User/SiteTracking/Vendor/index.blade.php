@extends('user.layouts.app')
@section('title', 'DevSync | Site Tracking')
@section('content')
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
    <main class="content px-20 py-8">
        <section class="main-header flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-800 ml-10">Manage Vendors</h1>
            <div class="flex justify-end">
                <a href="javascript:void(0)"
                    class="clear_db_filters px-6 py-3 bg-gray-600 rounded-md text-white font-medium tracking-wide hover:bg-gray-500 ml-auto mr-3">
                    <i class="fa-solid fa-filter-circle-xmark mr-3"></i>
                    <span class="font-plus-jakarta-sans">Clear Filter</span>
                </a>
                <button
                    class="px-6 py-3 bg-blue-600 rounded-md text-white font-medium tracking-wide hover:bg-blue-500 ml-auto"
                    onClick="addVendor()">
                    <i class="fa-solid fa-user-plus mr-3"></i>
                    <span class="font-plus-jakarta-sans">Add New</span>
                </button>
                <button onclick="deleteSelectedVendor()"
                    class="px-6 py-3 bg-red-600 rounded-md text-white font-medium tracking-wide hover:bg-red-500 ml-3 mr-6">
                    <i class="fa-solid fa-trash mr-3"></i>
                    <span class="font-plus-jakarta-sans">Delete Selected</span>
                </button>
            </div>
        </section>

        <div class="card bg-gray-300 p-6 rounded-md shadow-md">
            <table id="vendors-table" class="min-w-full leading-normal datatable-th">
                <thead>
                    <tr>
                        <th class="py-3 px-5 bg-indigo-800 font-medium uppercase text-sm text-gray-100">
                            <div class="flex items-center">
                                <input type="checkbox" id="select-all-checkbox"
                                    class="form-checkbox h-5 w-5 text-yellow-600 bg-gray-300 border-gray-300 rounded focus:ring-yellow-500 dark:focus:ring-yellow-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                            </div>
                        </th>
                        <th class="py-3 px-5 bg-indigo-800 font-medium uppercase text-sm text-gray-100">
                            Name</th>
                        <th class="py-3 px-5 bg-indigo-800 font-medium uppercase text-sm text-gray-100">
                            Description</th>
                        <th class="py-3 px-5 bg-indigo-800 font-medium uppercase text-sm text-gray-100">
                            Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- DataTable will populate this area -->
                </tbody>
            </table>
        </div>
    </main>
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden" id="vendor-modal"
        aria-hidden="true">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl transform transition-all duration-500 ease-out opacity-0 translate-y-[-50%]"
            id="modal-content">
            <div class="flex justify-between items-center p-5 border-b border-gray-200 mt-2">
                <h4 class="text-lg font-semibold text-gray-800" id="VendorModal"><i class="fa-solid fa-user-plus mr-2"></i>
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
                <form action="javascript:void(0)" id="VendorForm" name="VendorForm" class="space-y-4" novalidate
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div
                        class="flex flex-col items-center w-full mb-2 space-x-0 space-y-2 sm:flex-row sm:space-x-4 sm:space-y-0">
                        <div class="w-full">
                            <label for="name" class="block mb-1 text-sm font-medium text-indigo-900 dark:text-white">
                                Vendor Name<span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name" name="name" placeholder="Vendor Name"
                                class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                data-parsley-required="true" data-parsley-required-message="Enter your vendor name."
                                required>
                        </div>
                        <div class="w-full">
                            <label for="description" class="block mb-1 text-sm font-medium text-indigo-900 dark:text-white">
                                Description<span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="description" name="description" placeholder="Description"
                                class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                data-parsley-required="true" data-parsley-required-message="Enter your description."
                                required>
                        </div>
                    </div>
                    <div class="flex justify-start">
                        <button type="submit"
                            class="text-white mr-2 mt-2 bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                            Submit
                        </button>
                        <button type="reset" id="btn-reset"
                            class="mt-2 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                            Reset
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        //datatable
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#vendors-table').DataTable({
                processing: false,
                serverSide: true,
                filter: true,
                ajax: "{{ route('user.vendor.list') }}",
                responsive: true,
                columns: [{
                        data: 'id',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            return '<input type="checkbox" class="form-checkbox h-5 w-5 checkbox w-4 h-4 text-yellow-600 bg-gray-300 border-gray-300 rounded focus:ring-yellow-500" data-id="' +
                                data + '">';
                        }
                    },
                    {
                        data: 'name',
                        name: 'name',
                        orderable: false
                    },
                    {
                        data: 'description',
                        name: 'description',
                        orderable: false
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
                    api.columns([1, 2]).every(function() {
                        var column = this;
                        var input = $(
                                '<br><input type="text" class="w-60 mt-2 h-8 text-black pl-4 pr-4 rounded-md form-input focus:border-indigo-600 focus:ring-indigo-600 bg-white border border-gray-300" placeholder="Filter"/>'
                            )
                            .appendTo($(column.header()))
                            .on('input', function() {
                                shouldSort = false;
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val, true, false).draw();
                            });
                    });
                }
            });

            //clear filter
            $('.clear_db_filters').click(function() {
                table.search('').columns().search('').draw();
                $('#vendors-table thead input[type="text"]').val(''); // Clear the input values
            });
        });
        //model
        function addVendor() {
            $('#VendorModal').html("Add New Vendor");
            $('#vendor-modal').removeClass('hidden');
            $('#modal-content').addClass('fade-in-down');
        }
        //model close
        function closeModal() {
            $('#vendor-modal').addClass('hidden');
            $('#modal-content').removeClass('fade-in-down');
        }
        //reset model form
        $(document).ready(function() {
            $('#btn-reset').click(function() {
                $('#VendorForm').trigger("reset");
            });
        });
        //add vendor ajax
        $('#VendorForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('user.vendor.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function() {
                    closeModal();
                    $('#vendors-table').DataTable().ajax.reload(null, false);
                },
                error: function(data) {
                    // console.log(data);
                    // Display error message
                    // alert('An error occurred while processing your request. Please try again.');
                }
            });
        });

        //parsley validation
        $('#VendorForm').parsley({
            errorsWrapper: '<div class="text-red-600 text-sm"></div>',
            errorTemplate: '<span></span>'
        });
        //edit vendor ajax
        function editVendorFunc(id) {
            $.ajax({
                headers: {
                    "Accept": "application/json",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: "POST",
                url: "{{ route('user.vendor.edit') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('#VendorModal').html("Edit Vendor");
                    $('#vendor-modal').removeClass('hidden');
                    $('#modal-content').addClass('fade-in-down');
                    $('#id').val(res.id);
                    $('#name').val(res.name);
                    $('#description').val(res.description);
                }
            });
        }
        //delete vendor ajax
        function deleteVendorFunc(id) {
            Swal.fire({
                title: '<strong>Sure want to delete?</strong>',
                icon: 'warning',
                iconColor: '#d33',
                html: '<span>This cannot be undone</span>',
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: '<i class="fa-solid fa-check mr-2"></i> Yes',
                confirmButtonColor: '#d33',
                cancelButtonText: '<i class="fa-solid fa-xmark mr-5"></i>No',
                cancelButtonAriaLabel: 'Thumbs down'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('user.vendor.destroy') }}",
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function(res) {
                            var oTable = $('#vendors-table').dataTable();
                            oTable.fnDraw(false);
                        }
                    });
                }
            });
        }
        //all checkbox selection
        $('#select-all-checkbox').on('click', function() {
            var isChecked = $(this).prop('checked');
            $('.checkbox').prop('checked', isChecked);
        });

        $('#vendors-table').on('click', '.checkbox', function() {
            var isChecked = $(this).prop('checked');
            if (!isChecked) {
                $('#select-all-checkbox').prop('checked', false);
            }
        });
        //multiple delete ajax
        function deleteSelectedVendor() {
            var selectedIds = $('.checkbox:checked').map(function() {
                return $(this).data('id');
            }).get();
            // console.log(selectedIds);

            if (selectedIds.length === 0) {
                Swal.fire('Error!', 'Please select at least one record to delete.', 'error');
                return;
            }

            Swal.fire({
                title: '<strong>Sure want to delete selected data?</strong>',
                icon: 'warning',
                iconColor: '#d33',
                html: '<span>This cannot be undone</span>',
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: '<i class="fa-solid fa-check mr-2"></i> Yes',
                confirmButtonColor: '#d33',
                cancelButtonText: '<i class="fa-solid fa-xmark mr-5"></i>No',
                cancelButtonAriaLabel: 'Thumbs down'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('user.vendor.delete-selected') }}",
                        data: {
                            ids: selectedIds
                        },
                        success: function(response) {
                            $('#vendors-table').DataTable().ajax.reload();
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire('Cancelled', 'Your records are safe', 'error');
                }
            });
        }
    </script>

@endsection

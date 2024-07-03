@extends('admin.layouts.app')
@section('title', 'DevSync | Admin Dashboard')
@section('content')

    <main class="container mx-auto p-2">
        <div class="content">
            <section class="main-header flex justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-800"><i class="fa-solid fa-users mr-5 ml-8"></i>Manage Users</h1>
                <div class="flex justify-end">
                    <button
                        class="px-6 py-3 bg-blue-600 rounded-md text-white font-medium tracking-wide hover:bg-blue-500  ml-auto">
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

    <script type="text/javascript">
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
                }
            });
        });
    </script>

@endsection

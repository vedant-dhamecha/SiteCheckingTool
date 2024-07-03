<header class="flex items-center justify-between px-6 py-4 bg-white border-b-4 border-indigo-600">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Parsley.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
    <!-- Include Parsley CSS (optional, for better styling) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.css">
    <!-- Croppie -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
    <!--font awesoem for icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/datatable.css') }}">
    <div class="flex items-center">
        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>

        <div class="relative mx-4 lg:mx-0">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
            <input class="w-32 pl-10 pr-4 rounded-md form-input sm:w-64 focus:border-indigo-600" type="text"
                placeholder="Search">
        </div>
    </div>

    <div class="flex items-center">
        <button class="text-blue-600 font-bold mr-3" id="user-menu-button">
            {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}
        </button>
        <div x-data="{ dropdownOpen: false }" class="relative">
            <button id="user-menu-button"
                class="relative block w-8 h-8 overflow-hidden rounded-full shadow focus:outline-none"
                @click="dropdownOpen = !dropdownOpen">
                @if (!auth()->user()->profile)
                    <img class="object-cover w-full h-full" src="{{ asset('images/user.jpg') }}"
                        alt="Default user avatar">
                @else
                    <img class="object-cover w-full h-full" src="{{ asset('storage/' . auth()->user()->profile) }}"
                        alt="">
                @endif
            </button>

            <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                class="absolute right-0 z-10 w-48 mt-2 overflow-hidden bg-white rounded-md shadow-xl"
                style="display: none;" id="user-menu">
                <a href="{{ route('admin.profile') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white"
                    role="menuitem"><i class="fa-solid fa-user mr-2"></i>Profile</a>
                <a href="{{ route('admin.password') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white"
                    role="menuitem"><i class="fa-solid fa-key mr-2"></i>Change Password</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white"
                    role="menuitem"><i class="fa-solid fa-gear mr-2"></i>Site Settings</a>
                <a href="{{ route('admin.logout') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white"
                    role="menuitem"><i class="fa-solid fa-right-from-bracket mr-2"></i>Logout</a>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var userMenu = document.getElementById("user-menu");
        var userMenuButton = document.getElementById("user-menu-button");
        userMenuButton.addEventListener('click', function(event) {
            event.stopPropagation();
            toggleMenu();
        });

        function toggleMenu() {
            if (userMenu.style.display === "none" || userMenu.style.display === "") {
                userMenu.style.display = "block";
                document.addEventListener('click', closeMenuOutsideClick);
            } else {
                userMenu.style.display = "none";
                document.removeEventListener('click', closeMenuOutsideClick);
            }
        }

        function closeMenuOutsideClick(event) {
            if (!userMenu.contains(event.target) && event.target !== userMenuButton) {
                userMenu.style.display = "none";
                document.removeEventListener('click', closeMenuOutsideClick);
            }
        }
    });
</script>

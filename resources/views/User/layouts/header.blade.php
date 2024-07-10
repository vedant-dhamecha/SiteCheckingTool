<header>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/datatable.css') }}">

    <nav class="bg-gray-800">
        <div class="mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <button type="button"
                        class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        aria-controls="mobile-menu" aria-expanded="false" onclick="toggleMobileMenu()">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Open main menu</span>
                        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start z-10">
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4">
                            <a href="{{ route('user.dashboard') }}"
                                class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white"
                                aria-current="page">Home</a>
                            <div class="relative group">
                                <button
                                    class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white site-tracking-btn">
                                    Site Tracking<i class="fa-solid fa-caret-down ml-8"></i>
                                </button>
                                <div
                                    class="absolute hidden group-hover:block bg-gray-700 mt-2 rounded-md shadow-lg site-tracking-menu flex flex-col">
                                    <a href="{{ route('home') }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-600">
                                        <i class="fa-solid fa-window-maximize mr-2"></i>Dashboard
                                    </a>
                                    <a href="{{ route('user.vendor') }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-600">
                                        <i class="fa-solid fa-user-gear mr-2"></i>Vendor
                                    </a>
                                    <a href="{{ route('user.customersite') }}"
                                        class="block px-4 py-2 text-sm text-white hover:bg-gray-600">
                                        <i class="fa-solid fa-chart-line mr-2"></i>Customer Site
                                    </a>
                                </div>
                            </div>
                            <a href="#"
                                class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Team</a>
                            <a href="#"
                                class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Projects</a>
                            <a href="#"
                                class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Calendar</a>
                        </div>
                    </div>
                </div>
                <div
                    class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <button type="button"
                        class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                        <span class="absolute -inset-1.5"></span>
                        <span class="sr-only">View notifications</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                        </svg>
                    </button>

                    <div class="relative ml-3">
                        <div>
                            <button type="button"
                                class="relative flex items-center rounded-full bg-gray-800 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true"
                                onclick="toggleMenu()">
                                <div class="text-white mr-3">
                                    {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</div>
                                <span class="absolute -inset-1.5"></span>
                                <span class="sr-only">Open user menu</span>
                                @if (!auth()->user()->profile)
                                    <img class="h-8 w-8 rounded-full" src="{{ asset('images/user.jpg') }}"
                                        alt="Default user avatar">
                                @else
                                    <img class="h-8 w-8 rounded-full"
                                        src="{{ asset('storage/' . auth()->user()->profile) }}" alt="">
                                @endif
                            </button>
                        </div>
                        <div class="absolute z-10 mt-3 w-44 origin-top-right rounded-sm bg-gray-500 py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                            tabindex="-1" id="user-menu" style="display: none;">
                            <a href="{{ route('user.profile') }}"
                                class="block px-4 py-2 text-sm text-white hover:bg-gray-700" role="menuitem"
                                tabindex="-1"><i class="fa-solid fa-user mr-2"></i>Profile</a>
                            <a href="{{ route('user.password') }}"
                                class="block px-4 py-2 text-sm text-white hover:bg-gray-700" role="menuitem"
                                tabindex="-1"><i class="fa-solid fa-key mr-2"></i>Change Password</a>
                            <a href="{{ route('user.logout') }}"
                                class="block px-4 py-2 text-sm text-white hover:bg-gray-700" role="menuitem"
                                tabindex="-1"><i class="fa-solid fa-right-from-bracket mr-2"></i>Sign out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sm:hidden" id="mobile-menu" style="display: none;">
            <div class="space-y-1 px-2 pb-3 pt-2">
                <a href="#" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white"
                    aria-current="page">Dashboard</a>
                <a href="#"
                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Team</a>
                <a href="#"
                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Projects</a>
                <a href="#"
                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Calendar</a>
            </div>
        </div>
    </nav>

    <script>
        function toggleMobileMenu() {
            var menu = document.getElementById("mobile-menu");
            if (menu.style.display === "none" || menu.style.display === "") {
                menu.style.display = "block";
            } else {
                menu.style.display = "none";
            }
        }

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

            var siteTrackingBtn = document.querySelector('.site-tracking-btn');
            var siteTrackingMenu = document.querySelector('.site-tracking-menu');
            var hideTimeout;

            siteTrackingBtn.addEventListener('mouseenter', function() {
                clearTimeout(hideTimeout);
                siteTrackingMenu.classList.remove('hidden');
            });

            siteTrackingBtn.addEventListener('mouseleave', function() {
                hideTimeout = setTimeout(function() {
                    siteTrackingMenu.classList.add('hidden');
                }, 300);
            });

            siteTrackingMenu.addEventListener('mouseenter', function() {
                clearTimeout(hideTimeout);
            });

            siteTrackingMenu.addEventListener('mouseleave', function() {
                hideTimeout = setTimeout(function() {
                    siteTrackingMenu.classList.add('hidden');
                }, 300);
            });
        });
    </script>
</header>

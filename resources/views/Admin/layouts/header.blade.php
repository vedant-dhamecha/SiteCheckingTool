<header class="flex items-center justify-between px-6 py-4 bg-white border-b-4 border-indigo-600">
    <div class="flex items-center">
        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>

        <div class="relative mx-4 lg:mx-0">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                    <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
            <input class="w-32 pl-10 pr-4 rounded-md form-input sm:w-64 focus:border-indigo-600" type="text" placeholder="Search">
        </div>
    </div>

    <div class="flex items-center">
        <div class="text-blue-600 font-bold mr-3">
            Vedant Dhamecha
        </div>
        <div x-data="{ dropdownOpen: false }" class="relative">
            <button id="user-menu-button" class="relative block w-8 h-8 overflow-hidden rounded-full shadow focus:outline-none" @click="dropdownOpen = !dropdownOpen">
                <img class="object-cover w-full h-full" src="https://images.unsplash.com/photo-1528892952291-009c663ce843?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=296&q=80" alt="Your avatar">
            </button>

            <div x-show="dropdownOpen" @click.away="dropdownOpen = false" class="absolute right-0 z-10 w-48 mt-2 overflow-hidden bg-white rounded-md shadow-xl" style="display: none;" id="user-menu">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white" role="menuitem">Profile</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white" role="menuitem">Products</a>
                <a href="/login" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white" role="menuitem">Logout</a>
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

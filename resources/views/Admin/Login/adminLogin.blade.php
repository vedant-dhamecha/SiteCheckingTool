<!DOCTYPE html>
<html lang="{{ $page->language ?? 'en' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="referrer" content="always">

    <title>DevSync | Admin Login</title>

    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Include Parsley CSS (optional, for better styling) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.css">
</head>

<body class="bg-gray-900 text-gray-100 justify-center h-screen">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mt-10 mx-auto w-40 h-auto" src="{{ asset('images/Logo.png') }}" alt="DevSync">
        </div>

        <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="{{ route('admin.login.post') }}" method="POST" id="loginForm"
                novalidate="" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-100">Email
                        address</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" autocomplete="email"
                            class="block w-full rounded-md border-0 py-1.5 bg-gray-800 text-gray-100 placeholder-gray-400 shadow-sm ring-1 ring-inset ring-gray-700 focus:ring-2 focus:ring-inset focus:ring-indigo-400 sm:text-sm sm:leading-6 pl-3"
                            data-parsley-type="email" data-parsley-required="true"
                            data-parsley-required-message="Enter your email address."
                            data-parsley-pattern="/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i"
                            data-parsley-pattern-message="Please enter a valid email address." required>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-100">Password</label>
                        <div class="text-sm">
                            <a href="#" class="font-semibold text-indigo-400 hover:text-indigo-300">Forgot
                                password?</a>
                        </div>
                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password"
                            class="pl-3 block w-full rounded-md border-0 py-1.5 bg-gray-800 text-gray-100 placeholder-gray-400 shadow-sm ring-1 ring-inset ring-gray-700 focus:ring-2 focus:ring-inset focus:ring-indigo-400 sm:text-sm sm:leading-6"
                            required data-parsley-minlength="8"
                            data-parsley-minlength-message="Password must be at least 8 characters."
                            data-parsley-required="true" data-parsley-required-message="Enter your password.">
                    </div>
                </div>
                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-400">Sign
                        in</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Parsley.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
    <script>
        // Initialize Parsley on the form
        $('#loginForm').parsley({
            errorsWrapper: '<div class="text-red-600 text-sm"></div>', // Customize error message wrapper
            errorTemplate: '<span></span>' // Customize error message template
        });
    </script>

</body>

</html>

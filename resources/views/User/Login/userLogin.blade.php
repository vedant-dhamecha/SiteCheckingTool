@extends('user.login.layouts.app')
@section('title', 'DevSync | User Login')
@section('content')
    <div id="wrapper">
        <div id="left">
            <div id="signin">
                <div class="logo">
                    <img src="{{ asset('images/Logo.png') }}" alt="DevSync" />
                </div>
                <form method="POST" action="{{ route('user.login.post') }}" id="loginForm" novalidate=""
                    enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label>Email</label>
                        <input type="text" name="email" class="text-input" value="{{ old('email') }}"
                            data-parsley-type="email" data-parsley-required="true"
                            data-parsley-required-message="Enter your email address."
                            data-parsley-pattern="/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i"
                            data-parsley-pattern-message="Please enter a valid email address." required />
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label>Password</label>
                        <input type="password" name="password" class="text-input" required data-parsley-minlength="8"
                            data-parsley-minlength-message="Password must be at least 8 characters."
                            data-parsley-required="true" data-parsley-required-message="Enter your password." />
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="primary-btn">Sign In</button>
                </form>
                @if (session('error'))
                    <div class="text-danger">{{ session('error') }}</div>
                @endif
            </div>
        </div>
        <div id="right">
            <div id="showcase">
                <div class="showcase-content">
                    <img src="{{ asset('images/userlogin.png') }}" alt="user login image" class="showcase-img" />
                </div>
            </div>
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

@endsection

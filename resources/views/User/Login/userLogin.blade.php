@extends('user.login.layouts.app')
@section('title', 'DevSync | User Login')
@section('content')

    <div id="wrapper">
        <div id="left">
            <div id="signin">
                <div class="logo">
                    <img src="{{ asset('images/Logo.png') }}" alt="DevSync" />
                </div>
                <form method="POST" action="{{ route('user.login.post') }}">
                    @csrf
                    <div>
                        <label>Email</label>
                        <input type="text" name="email" class="text-input" value="{{ old('email') }}" />
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label>Password</label>
                        <input type="password" name="password" class="text-input" />
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="primary-btn">Sign In</button>
                </form>
                @if(session('error'))
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

@endsection

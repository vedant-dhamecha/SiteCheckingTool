@extends('user.login.layouts.app')
@section('title', 'DevSync | User Login')
@section('content')

    <div id="wrapper">
        <div id="left">
            <div id="signin">
                <div class="logo">
                    <img src="{{ asset('images/Logo.png') }}" alt="DevSync" />
                </div>
                <form action="{{ route('user.login.post') }}" method="POST" id="handleAjax">
                    @csrf
                    <div>
                        <label for="email_address">Email</label>
                        <input type="text" id="email_address" name="email" class="text-input" />
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input type="password" class="text-input" name="password" />
                    </div>
                    <button type="submit" class="primary-btn">Sign In</button>
                </form>
                {{-- <div class="or">
                    <hr class="bar" />
                    <span>OR</span>
                    <hr class="bar" />
                </div> --}}
                {{-- <a href="#" class="secondary-btn">Create an account</a> --}}
            </div>
            {{-- <div id="main-footer">
                <p>Copyright &copy; 2018, Sluralpright All Rights Reserved <a href="#">terms of use</a> | <a href="#">Privacy Policy</a></p>
            </div> --}}
        </div>
        <div id="right">
            <div id="showcase">
                <div class="showcase-content">
                    <img src="{{ asset('images/userlogin.png') }}" alt="user login image" class="showcase-img" />
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function() {
            $(document).on("submit", "#handleAjax", function() {
                var e = this;
                $(this).find("[type='submit']").html("Login...");
                $.ajax({
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $(e).find("[type='submit']").html("Login");
                        if (data.status) {
                            window.location = data.redirect;
                        } else {
                            $(".alert").remove();
                            $.each(data.errors, function(key, val) {
                                $("#errors-list").append(
                                    "<div class='alert alert-danger'>" + val +
                                    "</div>");
                            });
                        }
                    }
                });
                return false;
            });
        });
    </script>

@endsection

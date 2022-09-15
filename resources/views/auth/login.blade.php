@extends('layouts.app')
@section('content')
    @push('styles')
        <style>
            .or {
                padding: 10px;
                text-align: center;
                margin: 0 auto;
                position: relative;
            }

            .or:after {
                content: "";
                width: 45%;
                height: 1px;
                background-color: #000;
                position: absolute;
                right: 0;
                top: 50%;
            }

            .or:before {
                content: "";
                width: 45%;
                height: 1px;
                background-color: #000;
                position: absolute;
                left: 0;
                top: 50%;
            }
        </style>
    @endpush
    <!-- login-page -->

    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li>Login</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /.page-header-->
    <!-- login-form -->

    <div class="content">
        <div class="container">
            <div class="box">
                <div class="row">
                    <div class="col-lg-offset-1 col-lg-5 col-md-offset-1 col-md-5 col-sm-12 col-xs-12 ">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 mb20">
                                    <h3 class="mb10">Login</h3>
                                </div>
                                <!-- form -->
                                <form id="loginForm" action="{{ route('login') }}" method="post">
                                    @csrf
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label sr-only" for="email"></label>
                                            <span
                                                style="font-size: 12px;letter-spacing: 2px;font-style: italic;display: block;">Admin
                                                email: admin@admin.com</span>

                                            <div class="login-input">
                                                <input id="email" name="email" type="text" data-spry='email'
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    placeholder="Enter your email id" required>
                                                <div class="login-icon"><i class="fa fa-user"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label sr-only"></label>
                                            <span
                                                style="font-size: 12px;letter-spacing: 2px;font-style: italic;display: block;">Admin
                                                password: 123456</span>

                                            <div class="login-input">
                                                <input name="password" type="password" data-spry='password'
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    placeholder="******" required>
                                                <div class="login-icon"><i class="fa fa-lock"></i></div>
                                                <div class="eye-icon"><i class="fa fa-eye"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb20 ">
                                        <button type="submit" class="btn btn-primary btn-block mb10">Login</button>
                                        <div>
                                            <p>Don't have an Acount? <a href="{{ route('register') }}">Register</a></p>
                                        </div>
                                        <div class="forgot-grid">
                                            <div class="forgot">
                                                <div class="forgot">
                                                    @if (Route::has('password.request'))
                                                        <a href="{{ route('password.request') }}">
                                                            {{ __('Forgot Your Password?') }}
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="clearfix"> </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                    <p class="or"> OR </p>
                                    <h4 class="mb20">Login With</h4>
                                    <div class="social-media">
                                        <a href="#" class="btn-social-rectangle btn-facebook"><i
                                                class="fa fa-facebook"></i><span class="social-text">Facebook</span></a>
                                        <a href="#" class="btn-social-rectangle btn-twitter"><i
                                                class="fa fa-twitter"></i><span class="social-text">Twitter</span> </a>
                                        <a href="#" class="btn-social-rectangle btn-googleplus"><i
                                                class="fa fa-google-plus"></i><span class="social-text">Google
                                                Plus</span></a>
                                    </div>
                                </div>
                                <!-- /.form -->
                            </div>
                        </div>
                    </div>
                    <!-- features -->
                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 ">
                        <div class="box-body">
                            <div class="feature-left">
                                <div class="feature-icon">
                                    <img src="./images/feature_icon_1.png" alt="">
                                </div>
                                <div class="feature-content">
                                    <h4>Loyalty Points</h4>
                                    <p>Aenean lacinia dictum risvitae pulvinar disamer seronorem ipusm dolor sit manert.</p>
                                </div>
                            </div>
                            <div class="feature-left">
                                <div class="feature-icon">
                                    <img src="./images/feature_icon_2.png" alt="">
                                </div>
                                <div class="feature-content">
                                    <h4>Instant Checkout</h4>
                                    <p>Aenean lacinia dictum risvitae pulvinar disamer seronorem ipusm dolor sit manert.</p>
                                </div>
                            </div>
                            <div class="feature-left">
                                <div class="feature-icon">
                                    <img src="./images/feature_icon_3.png" alt="">
                                </div>
                                <div class="feature-content">
                                    <h4>Exculsive Offers</h4>
                                    <p>Aenean lacinia dictum risvitae pulvinar disamer seronorem ipusm dolor sit manert.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.features -->
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src={{ asset('/js/SpryValidation.min.js') }}></script>
        <script src={{ asset('/js/spryValidator-V1.js') }}></script>

        <script>
            $("#loginForm").spryValidator({
                email: {
                    isRequired: true,
                },
                password: {
                    isRequired: true,
                },
            });

            // console.log($(".eye-icon"));

            $(".eye-icon").on('click', function() {
                var input = $(this).parent().find('input');
                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                } else {
                    input.attr('type', 'password');
                }
            })
        </script>
    @endpush
@endsection

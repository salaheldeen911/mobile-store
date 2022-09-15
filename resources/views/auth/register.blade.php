@extends('layouts.app')


@section('content')
    @push('styles')
        <link rel="stylesheet" href={{ asset('/css/spryValidator-V1.css') }}>
    @endpush
    <!-- sign-up form -->
    <div class="content">
        <div class="container">
            <div class="box sing-form">
                <div class="row">
                    <div class="col-lg-offset-1 col-lg-5 col-md-offset-1 col-md-5 col-sm-12 col-xs-12 ">
                        <!-- form -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 mb20">
                                    <h3 class="mb10">{{ __('Create your account') }}</h3>
                                    <p>Please fill all Resgister form Fields Below. </p>
                                </div>
                                <form id="registerForm" action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label sr-only" for="name"></label>
                                            <div class="login-input">

                                                <input id="name" name="name" type="text" data-spry='username'
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    placeholder="Enter Your Name" required>
                                            </div>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label sr-only" for="email"></label>
                                            <div class="login-input">

                                                <input id="email" name="email" type="email" data-spry='email'
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    placeholder="Enter Your email" required>
                                            </div>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label sr-only" for="password">

                                            </label>
                                            <div class="login-input">

                                                <input id="password" name="password" type="password" data-spry='password'
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    placeholder="Enter Your Password" required>
                                                <div class="eye-icon"><i class="fa fa-eye"></i></div>
                                            </div>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label sr-only" for="password_confirmation">

                                            </label>
                                            <div class="login-input">

                                                <input id="password_confirmation" name="password_confirmation"
                                                    type="password"
                                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                                    placeholder="Password Confirmation" data-spry='confirm' required>
                                                <div class="eye-icon"><i class="fa fa-eye"></i></div>
                                            </div>
                                            @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                        <input type='submit' class="btn btn-primary btn-block mb10" name value="Register">
                                        <div>
                                            <p>Already have an account? <a
                                                    href="{{ route('login') }}">{{ __('Login Now »') }}</a></p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.form -->
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
    <!-- /.sign-up form -->

    @push('scripts')
        <script src={{ asset('/js/SpryValidation.min.js') }}></script>
        <script src={{ asset('/js/spryValidator-V1.js') }}></script>

        <script>
            $("#registerForm").spryValidator({
                username: {
                    isRequired: true,
                    startAlphaChars: 2
                },
                email: {
                    isRequired: true,
                },
                password: {
                    isRequired: true,
                    minChars: 8
                },
                confirm: {
                    isRequired: true
                },
                errorMessages: {
                    startAlphaChars: "Your name must start with 2 letters at least",
                    minChars: "The password must be at least 8 characters."
                }
            })
        </script>
    @endpush
@endsection

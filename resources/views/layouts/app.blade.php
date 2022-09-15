<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description"
        content="create ecommerce website template for your online store, responsive mobile templates">
    <meta name="keywords" content="ecommerce website templates, online store,">
    <title> Mobistore Online Mobile Store Template </title>
    <!-- Bootstrap -->
    <link href={{ asset('css/bootstrap.min.css') }} rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Style CSS -->
    <link href={{ asset('css/style.css') }} rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">
    <!-- owl-carousel -->
    <link href={{ asset('css/owl.carousel.css') }} rel="stylesheet">
    <link href={{ asset('css/owl.theme.default.css') }} rel="stylesheet">
    <!-- FontAwesome CSS -->
    <link href={{ asset('css/font-awesome.min.css') }} rel="stylesheet">
    <link rel="stylesheet" href={{ asset('/css/spryValidator-V1.css') }}>

    <style>
        #cartContainer {
            height: 0;
        }

        .header_container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 50%;
        }

        .wish_list_icon {
            position: absolute !important;
            left: 16px !important;
            font-size: 15px !important;
            color: orangered !important;
        }

        .menu-button {
            margin-right: 50px;
        }

        @media (max-width: 1024px) {
            .wish_list_icon {
                left: 9px !important;
            }
        }

        @media (max-width: 785px) {
            .wish_list_icon {
                left: -6px !important;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- top-header-->
    <div id="preloader"></div>
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-md-4 hidden-sm hidden-xs">
                    <p class="top-text">Flexible Delivery, Fast Delivery.</p>
                </div>
                <div class="col-md-8 col-xs-12 d-flex justify-content-end">
                    <ul>
                        <li>+180-123-4567</li>
                        <li>info@demo.com</li>
                        <li><a href="#">Help</a></li>
                    </ul>
                </div>
            </div>
            <!-- /.top-header-->
        </div>
    </div>
    <!-- header-section-->
    <div class="header-wrapper">
        <div class="container" style="margin-bottom: -15px;">
            <div class="row">
                <div class="col-xs-12">
                    <div class="header_container">
                        <!-- logo -->
                        <div class="logo">
                            <a href="{{ route('welcome') }}"><img src="{{ asset('images/logo.png') }}" alt="">
                            </a>
                        </div>
                        <div class="account-section" style='width:100%;'>
                            <ul style="display:flex; align-items:center; float: right;">
                                @guest
                                    @if (Route::has('login'))
                                        <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                                    @endif

                                    @if (Route::has('register'))
                                        <li><a href="{{ route('register') }}">{{ __('Sign Up') }}</a></li>
                                    @endif
                                    <li>
                                        <a href="{{ route('cart.index') }}" class="title p-0">
                                            <i class="fa fa-shopping-cart"></i>
                                            <sup class="cart-quantity">0</sup>
                                        </a>
                                    </li>
                                @endguest

                                @auth
                                    <li><a href="{{ route('orders') }}" class="title">My Orders</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                    <li>
                                        <a href="{{ route('cart.index') }}" class="title">
                                            <i class="fa fa-shopping-cart"></i>
                                        </a>
                                        <a href="#" class="title">
                                            <sup id="cartQuantity" class="cart-quantity"> {{ $cart->products->count() }}
                                            </sup>
                                        </a>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                    </div>

                </div>
                <!-- /.logo -->
                <!-- search -->
                <div class="col-xs-12">
                    <form action="{{ route('filter') }}">
                        <div class="search-bg mb-4">
                            <input type="text" name="name" class="form-control"
                                placeholder="Search By Phone Name">
                            <button type="Submit"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <!-- /.search -->

            </div>
        </div>
        <!-- navigation -->
        <div class="navigation">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- navigations-->
                        <div id="navigation" style="margin-left: 1.5%">
                            <ul>
                                <li class="active"><a href="{{ route('welcome') }}">Home</a></li>
                                <li><a href="{{ route('products') }}">Products</a></li>
                                <li><a href="{{ route('orders') }}">Orders</a></li>
                                <li><a href="{{ route('cart.index') }}">Cart</a></li>
                                <li><a style="position: relative;" href="{{ route('wishlist') }}">
                                        <i class="shopping-icon fa fa-heart wish_list_icon"></i> Wish list
                                    </a></li>

                                <li class="has-sub"><a href="#">All</a>
                                    <ul>
                                        <li><a href="{{ route('products') }}">Products</a></li>
                                        <li><a href="{{ route('orders') }}">Orders</a></li>
                                        <li><a style="position: relative;" href="{{ route('wishlist') }}">Wish
                                                list</a></li>
                                        <li><a href="{{ route('cart.index') }}">Cart</a></li>

                                    </ul>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!-- /.navigations-->
                </div>
            </div>
        </div>
    </div>
    <!-- /. header-section-->

    @yield('content')


    <!-- footer -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <!-- footer-company-links -->
                <!-- footer-contact links -->
                <div class=" col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="footer-widget">
                        <h3 class="footer-title">Contact Info </h3>
                        <div class="contact-info">
                            <span class="contact-icon"><i class="fa fa-map-marker"></i></span>
                            <span class="contact-text">Muharam Bik,<br>
                                Alexandria
                                Egypt</span>
                        </div>
                        <div class="contact-info">
                            <span class="contact-icon"><i class="fa fa-phone"></i></span>
                            <span class="contact-text">+2-012-735-42-801</span>
                        </div>
                        <div class="contact-info">
                            <span class="contact-icon"><i class="fa fa-envelope"></i></span>
                            <span class="contact-text">salah.eldeen.mail@gmail.com</span>
                        </div>
                    </div>
                </div>
                <!-- /.footer-useful-links -->
                <div class=" col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="footer-widget">
                        <h3 class="footer-title">Quick Links</h3>
                        <ul class="arrow">
                            <li><a href="{{ route('welcome') }}">Home </a></li>
                            <li><a href="{{ route('wishlist') }}">Wishlist</a></li>
                            <li><a href="{{ route('cart.index') }}">Cart</a></li>
                            <li><a href="{{ route('orders') }}">Orders</a></li>
                            <li><a href="{{ route('products') }}">All Products</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.footer-useful-links -->
                <!-- footer-policy-list-links -->
                <div class=" col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="footer-widget">
                        <h3 class="footer-title">Skills</h3>
                        <ul class="arrow">
                            <li><a href="#">JavaScript</a></li>
                            <li><a href="#">JQUERY</a></li>
                            <li><a href="#">VueJS</a></li>
                            <li><a href="#">PHP</a></li>
                            <li><a href="#">Laravel</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.footer-policy-list-links -->
                <!-- footer-social links -->
                <div class=" col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="footer-widget">
                        <h3 class="footer-title">Connect With Us</h3>
                        <div class="ft-social">
                            <span><a href="#" class="btn-social btn-facebook"><i
                                        class="fa fa-facebook"></i></a></span>
                            <span><a href="#" class="btn-social btn-twitter"><i
                                        class="fa fa-twitter"></i></a></span>
                            <span><a href="#" class="btn-social btn-googleplus"><i
                                        class="fa fa-google-plus"></i></a></span>
                            <span><a href="#" class=" btn-social btn-linkedin"><i
                                        class="fa fa-linkedin"></i></a></span>
                            <span><a href="#" class=" btn-social btn-instagram"><i
                                        class="fa fa-instagram"></i></a></span>
                        </div>
                    </div>
                </div>
                <!-- /.footer-social links -->
            </div>
        </div>
        <!-- tiny-footer -->
        <div class="tiny-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="payment-method alignleft">
                            <ul>
                                <li><a href="#"><i class="fa fa-cc-paypal fa-2x"></i></a></li>
                                <li><a href="#"><i class="fa fa-cc-mastercard  fa-2x"></i></a></li>
                                <li><a href="#"><i class="fa fa-cc-visa fa-2x"></i></a></li>
                                <li><a href="#"><i class="fa fa-cc-discover fa-2x"></i></a></li>
                            </ul>
                        </div>
                        <p class="alignright">Copyright © All Rights Reserved 2020 Template Design by
                            <a href="https://easetemplate.com/" target="_blank"
                                class="copyrightlink">EaseTemplate</a>
                        </p>
                    </div>
                </div>
            </div>
            <!-- /. tiny-footer -->
        </div>
    </div>
    <!-- /.footer -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src={{ asset('js/jquery.min.js') }}></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src={{ asset('js/bootstrap.min.js') }}></script>
    <script src={{ asset('js/menumaker.js') }}></script>
    <script src={{ asset('js/jquery.sticky.js') }}></script>
    <script src={{ asset('js/sticky-header.js') }}></script>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $("#preloader").css("opacity", 0)
            }, 500)
        });
    </script>
    @stack('scripts')
</body>

</html>

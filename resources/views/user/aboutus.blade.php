@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
@endpush

@section('content')
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li><a href="{{ route('welcome') }}">Home</a></li>
                            <li><a href="{{ route('cart.index') }}">cart</a></li>
                            <li>checkout</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /.page-header-->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="box">
                        <div class="box-head">
                            <h2 class="head-title">Contact Us</h2>
                        </div>
                        <div class="box-body contact-form">
                            <div class="row">
                                <form>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label sr-only" for="name"></label>
                                            <input id="name" type="text" placeholder="Your  Name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label sr-only" for="phone"></label>
                                            <input id="phone" type="text" placeholder="Enter your Mobile Number" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label sr-only" for="email"></label>
                                            <input id="email" type="text" placeholder="Enter Email Address" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label sr-only" for="name"></label>
                                            <input id="subject" type="text" placeholder="Your Subject" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label sr-only" for="textarea"></label>
                                            <textarea class="form-control" id="textarea" name="textarea" rows="4" placeholder="Messages"></textarea>
                                        </div>
                                        <button type="submit" name="singlebutton" class="btn btn-primary">submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                      <!-- /.contact-form -->
                            <!-- address-block -->
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="box">
                        <div class="box-head">
                            <h2 class="head-title">Contact Info</h2>
                        </div>
                        <div class="box-body">
                            <div class="contact-block">
                                <h4>Corporate Headquater</h4>
                                <p>3718 Pretty View Lane Santa Rosa, CA 95401</p>
                            </div>
                            <div class="contact-block">
                                <h4>Sales Info &amp; Inquiries</h4>
                                <p class="mb0">Toll Free: <span class="text-default">180-456-8910</span></p>
                                <p class="mb0">Email: <span class="text-default">help@mobistore.com</span></p>
                            </div>
                            <div class="contact-block">
                                <h4>General Contact</h4>
                                <p class="mb0">Phone: <span class="text-default">180-123-4567</span></p>
                                <p class="mb0">Email: <span class="text-default">demo@mobistore.com</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.address-block -->
            </div>
            <!-- support-block -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="box">
                        <div class="box-head">
                            <h3 class="head-title">How Can We Help You?</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="suport-block">
                                        <div class="support-icon">
                                            <img src="./images/inquiry_icon.png" alt="">
                                        </div>
                                        <div class="support-content">
                                            <h4>Sales Inquiry</h4>
                                            <p>Suspendisse sodales venenatis velitut fringilla lorem on vulputateam augue nislpretium qutristique sodales serotut fringilla.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="suport-block">
                                        <div class="support-icon">
                                            <img src="./images/support_icon.png" alt="">
                                        </div>
                                        <div class="support-content">
                                            <h4>Customer Support</h4>
                                            <p>Pendisse sodales venenatis velitut fringilla lorem on vulputateam augue nislpretium qutristique sodales seron magna.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    
    @endpush
@endsection

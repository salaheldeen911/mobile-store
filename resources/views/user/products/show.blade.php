@extends('layouts.app')

@push('styles')
    {{-- <link rel="stylesheet" href="{{ asset('css/user/products/show.css') }}"> --}}
    <link href={{ asset('css/jquery.desoslide.min.css') }} rel="stylesheet">
    <link href={{ asset('css/animate.min.css') }} rel="stylesheet">

    <style>
        @media only screen and (max-width: 578px) {
            div.col-lg-2.col-md-2.col-sm-2.col-xs-3 {
                width: 25% !important;
            }

            div.col-lg-4.col-md-4.col-sm-10.col-xs-9 {
                width: 75% !important;
            }
        }

        #rating_erorr {
            display: none;
            color: red;
            margin-left: 20px;
        }

        .flex {
            display: flex;
            margin: 0 0 20px 14px
        }

        .delete {
            position: absolute;
            top: 0;
            right: 20px;
            font-size: 21px;
            cursor: pointer;
        }

        .delete:hover {
            color: red;
        }

        .cartError {
            display: none;
            color: red;
            margin-left: 8px;
        }

        .cartSuccess {
            display: none;
            color: green;
            margin-left: 20px;
        }

        .like-erorr {
            display: none;
            color: red;
            font-size: 14px;
        }

        a.product {
            color: #000;
            text-decoration: none;
            width: 100%;
            height: 100%;
        }

        .icon_holder.liked i {
            font-size: 22px;
            color: #ed6908;
        }

        .like_icon_container {
            width: 40px;
            position: relative;
        }

        .likesNum {
            position: absolute;
            bottom: 12%;
            left: 100%;
        }

        .shopping-icon {
            font-size: 21px;
            color: #848687
        }

        .shopping-icon:hover {
            font-size: 22px;
            color: #ed6908;
        }

        .likes {
            display: flex;
            justify-content: space-around;
            align-items: center;
            width: 50px;
            margin: 0 auto;
        }

        .shopping-icon.fa.fa-heart,
        .shopping-icon.fa.fa-shopping-cart {
            cursor: pointer;
        }

        .slider-img img {
            width: 100% !important;
            height: 100% !important;
        }

        .showcase-img {
            padding: 18px 0 0;
            max-width: 100%;
            flex-grow: 10;
            height: 80%;
        }

        .showcase-img img {
            max-width: 100%;
            height: 100%;
        }

        .showcase-block {
            width: 100%;
            height: 300px;
            padding-bottom: 10px;
        }

        .big_brand {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            align-items: start;
        }

        .big_brand .showcase-img {
            height: 100%;
        }

        .display-logo {
            height: 20%;
            margin: 0;
        }

        img.img-responsive.animated.fadeIn {
            width: 100%;
            height: 100%;
        }

        div.desoslide-overlay {
            display: none !important;
        }

        #slideshow {
            height: 100%;
        }

        .desoslide-wrapper {
            height: 100%;
        }
    </style>
@endpush

@section('content')
    <!-- page-header -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li>Product Single</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.page-header-->
    <!-- product-single -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="box">
                        <!-- product-description -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                                    <ul id="demo1_thumbs" class="slideshow_thumbs">
                                        <li>
                                            <a href="{{ asset($product->main_image) }}">
                                                <div class=" thumb-img"><img src="{{ asset($product->main_image) }}"
                                                        alt="">
                                                </div>
                                            </a>
                                        </li>
                                        @foreach ($product->subImages as $subImage)
                                            <li>
                                                <a href="{{ asset($subImage->sub_image) }}">
                                                    <div class=" thumb-img">
                                                        <img src="{{ asset($subImage->sub_image) }}" alt="">
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-10 col-xs-9">
                                    <div id="slideshow"></div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="product-single">
                                        <h2>{{ $product->brand . ' ' . $product->name }}
                                        </h2>
                                        <div data-rate="{{ floor($product->ratings->pluck('rating')->avg()) }}"
                                            class="product-rating rated">
                                            <span><i class="fa "></i></span>
                                            <span><i class="fa "></i></span>
                                            <span><i class="fa "></i></span>
                                            <span><i class="fa "></i></span>
                                            <span><i class="fa "></i></span>
                                            <span
                                                class="text-secondary">&nbsp;({{ round($product->ratings->pluck('rating')->avg(), 1) }}
                                                Review Stars)</span>
                                        </div>
                                        <p class="product-price" style="font-size: 38px;">${{ $product->price }}</p>
                                        <strike>${{ $product->old_price }}</strike>
                                        <p>{{ $product->main_camera }} MP Main Camera | {{ $product->front_camera }}
                                            MP Front Camera, {{ $product->ram }}GB RAM, {{ $product->battery }} mAh
                                            battery,
                                            {{ $product->operating_system }},
                                            {{ $product->processor }}, Network
                                            {{ $product->network }} </p>

                                        <button @auth id="AddToCart" @endauth
                                            @guest
onclick="alert('Please Login to add to cart')" @endguest type="submit"
                                            class="btn btn-default">
                                            <i class="fa fa-shopping-cart"></i>&nbsp;
                                            Add to cart
                                        </button>
                                        <p class="cartError">Already Added To Your Cart</p>
                                        <p class="cartSuccess">Added To Your Cart successfully</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="box-head scroll-nav">
                        <div class="head-title">
                            <a class="page-scroll active" href="#product">Product Details</a>
                            <a class="page-scroll" href="#rating">Ratings &amp; Reviews</a>
                            <a class="page-scroll" href="#review">Add Your Reviews</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- highlights -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div id="product" class="box">
                        <div class="box-body">
                            <div class="highlights">
                                <h4 class="product-small-title">Highlights</h4>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <ul class="arrow">
                                            <li> {{ $product->main_camera }} MP Main Camera |
                                                {{ $product->front_camera }} MP Front Camera </li>
                                            <li> {{ $product->ram }}GB RAM </li>
                                            <li> {{ $product->battery }} mAh battery </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <ul class="arrow">
                                            <li> {{ $product->operating_system }}
                                            </li>
                                            <li> {{ $product->processor }} </li>
                                            <li> Network {{ $product->network }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="highlights">
                                <h4 class="product-small-title">Specification</h4>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <h4>General</h4>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mb30">
                                        <ul>
                                            <li>Brand</li>
                                            <li>Serial Number</li>
                                            <li>Body Material</li>
                                            <li>Sim Card</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mb30">
                                        <ul>
                                            <li style="color: #1c1e1e;">
                                                {{ $product->brand }} </li>
                                            <li style="color: #1c1e1e;"> {{ $product->product_ID }} </li>
                                            <li style="color: #1c1e1e;">
                                                {{ $product->body_material }}
                                            </li>
                                            <li style="color: #1c1e1e;">
                                                {{ $product->sim_card }} </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <h4>Display</h4>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <ul>
                                            <li>Screen Size </li>
                                            <li>Display Resolution </li>
                                            <li>Pixel Density</li>
                                            <li>Screen Protection </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <ul>
                                            <li style="color: #1c1e1e;"> {{ $product->screen_size }} inch </li>
                                            <li style="color: #1c1e1e;">1280 X 720 Pixels</li>
                                            <li style="color: #1c1e1e;">294 PPI</li>
                                            <li style="color: #1c1e1e;">
                                                {{ $product->screen_protection }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- rating reviews  -->
            <div id="rating">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="box">
                            <div class="box-head">
                                <h3 class="head-title">Rating &amp; Reviews</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="rating-review w-100">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <h1> {{ round($product->ratings->pluck('rating')->avg(), 1) }} </h1>
                                            <div data-rate="{{ floor($product->ratings->pluck('rating')->avg()) }}"
                                                class="product-rating rated">
                                                <span><i class="fa "></i></span>
                                                <span><i class="fa "></i></span>
                                                <span><i class="fa "></i></span>
                                                <span><i class="fa "></i></span>
                                                <span><i class="fa "></i></span>
                                            </div>
                                            <p class="text-secondary"> {{ $product->ratings->count() }} Ratings &amp;
                                                Reviews</p>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <h2>{{ floor(($product->ratings->pluck('rating')->avg() / 5) * 100) }} %</h2>
                                            <p class="text-secondary">Based on {{ $product->ratings->count() }}
                                                Recommendations.</p>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <h4>Have you used this product?</h4>
                                            <a href="#review" class="btn btn-primary btn-sm">review</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.rating reviews  -->
                <!-- customers review  -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="box">
                            <div class="box-head">
                                <h3 class="head-title">Customer Reviews</h3>
                            </div>
                            <div class="box-body">
                                @if (!empty($product->ratings->toArray()))
                                    @foreach ($product->ratings as $rate)
                                        <div class="row">
                                            <div class="customer-reviews">
                                                <div class="delete">
                                                    <i class="fa fa-close"></i>
                                                    <form action="{{ route('rating.destroy', $rate->id) }} "
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                                <div class="flex">
                                                    <div data-rate="{{ $rate->rating }}" class="product-rating rated">
                                                        <span><i class="fa "></i></span>
                                                        <span><i class="fa "></i></span>
                                                        <span><i class="fa "></i></span>
                                                        <span><i class="fa "></i></span>
                                                        <span><i class="fa "></i></span>
                                                    </div>
                                                    <p class="reviews-text">By <span class="text-default">
                                                            {{ $user::where('id', $rate->user_id)->first()->name }}
                                                        </span> from
                                                        {{ $rate->created_at->diffForHumans() }} </p>
                                                </div>
                                                <div class="col-xs-12">
                                                    <p>{{ $rate->review }}</p>
                                                </div>
                                                <div class="col-xs-12">
                                                    <div class="divider-line"></div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p>No reviews available yet.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- customers review  -->
            <!-- reviews-form -->
            @auth

                <div id="review">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="box">
                                <div class="box-head">
                                    <h3 class="head-title">Add A Review</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="review-form">
                                            @if (!$product->ratings->where('user_id', auth()->user()->id)->first())
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div style="margin-bottom:10px;" class="review-rating">
                                                        <h5 style="display:inline;margin-bottom:10px">Your Rating : &nbsp;</h5>
                                                        <span><i data-rate="1" class="fa fa-star-o rating_star"></i></span>
                                                        <span><i data-rate="2" class="fa fa-star-o rating_star"></i></span>
                                                        <span><i data-rate="3" class="fa fa-star-o rating_star"></i></span>
                                                        <span><i data-rate="4" class="fa fa-star-o rating_star"></i></span>
                                                        <span><i data-rate="5" class="fa fa-star-o rating_star"></i></span>
                                                        <span id="rating_erorr"> Please rate the product first.</span>
                                                    </div>
                                                </div>

                                                <form id="reviewForm" action="{{ route('rating.store') }}" method="POST">
                                                    @csrf
                                                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <textarea id="textarea" data-spry="textarea" class="form-control" name="review" rows="4"></textarea>
                                                            <span id="my_counter_span"></span>
                                                        </div>
                                                        <input type='hidden' value="{{ $product->id }}" name="product_id">
                                                        <input id="rateValue" type='hidden' value="" name="rate">
                                                        <button id="submit" name="review_submit"
                                                            class="btn btn-primary">Submit</button>
                                                    </div>
                                                    @if ($errors->any())
                                                        <div class="alert alert-danger">
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </form>
                                            @else
                                                <p>You have already reviewed this product.</p>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endauth

            <!-- /.reviews-form -->
        </div>
    </div>
    <!-- /.product-description -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="box-head">
                    <h3 class="head-title">Related Product</h3>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="box-body">
                <div class="row">
                    @foreach ($products::randomProducts() as $product)
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb30">
                            <div class="product-block">
                                <a href="{{ route('show.product', $product->id) }}">
                                    <div class="product-img">
                                        <img src="{{ $product->main_image }}" alt="">
                                    </div>
                                </a>

                                <div class="product-content">
                                    <h5>
                                        <a href="{{ route('show.product', $product->id) }}" class="product-title">
                                            <span>{{ $product->brand . ' ' . $product->name }}</span>
                                            <strong>({{ $product->storage }},{{ $product->color }})</strong>
                                        </a>
                                    </h5>
                                    <div class="product-meta">
                                        <span class="product-price">${{ $product->price }}</span>
                                        <span class="discounted-price">${{ $product->old_price }}</span>
                                        <span
                                            class="offer-price">{{ floor(($product->getAttributes()['price'] / $product->getAttributes()['old_price']) * 100 - 100) }}%off</span>
                                    </div>
                                    <div class="shopping-btn">
                                        <span class="like_icon_container">
                                            <span class="likesNum"> {{ $product->likes }}</span>
                                            <span
                                                class="icon_holder @auth {{ $product->likes()->where(['user_id' => auth()->user()->id], ['product_id' => $product->id])->exists()? 'liked': '' }} @endauth"
                                                onclick={{ auth()->user() ? 'likeFunction(this)' : 'likeErorr(this)' }}
                                                data-product="{{ $product->id }}">
                                                <i class="shopping-icon fa fa-heart"></i>
                                            </span>
                                        </span>
                                        <span
                                            class="icon_holder @auth {{ !$cart->products->where('id', $product->id)->isEmpty() ? 'liked' : '' }} @endauth"
                                            onclick={{ auth()->user() ? 'cart(this)' : 'likeErorr(this)' }}
                                            data-product="{{ $product->id }}"
                                            @auth data-cart="{{ $cart->id }}" @endauth
                                            data-price="{{ $product->price }}">

                                            <i class="shopping-icon fa fa-shopping-cart"></i>
                                        </span>
                                    </div>

                                    <span class="like-erorr none">You have to login first</span>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- /.product-single -->
@endsection

@push('scripts')
    <script src="{{ asset('js/jquery.desoslide.min.js') }}"></script>
    <script src={{ asset('/js/SpryValidation.min.js') }}></script>
    <script src={{ asset('/js/spryValidator-V1.js') }}></script>

    <script>
        $('#slideshow').desoSlide({
            thumbs: $('ul.slideshow_thumbs li > a'),
            effect: {
                provider: 'animate',
                name: 'fade'
            }

        });


        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $(document).ready(function() {
            // hide the numbers of likes if equal 0
            $('.likesNum').each(function() {
                this.innerText == 0 ? this.style.display = "none" : this.style.display = "unset";
            });
        });

        function likeFunction(likeBtn) {
            let productId = likeBtn.dataset.product;
            let url = `${$(likeBtn).hasClass('liked') ? 'dislike' : 'like'}/${productId}`;
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    "product_id": productId
                },
                dataType: 'JSON',
                success: function(res) {
                    if (res.success) {
                        handelLike(likeBtn);
                    }
                }
            });
        }

        function handelLike(likeBtn) {
            let likesNumContainer = $(likeBtn).parent().find('.likesNum');
            if ($(likeBtn).hasClass('liked')) {
                let likesNum = parseInt(likesNumContainer.text(), 10) - 1;
                likesNumContainer.text(likesNum);
                likesNumContainer.text() == 0 ? likesNumContainer.hide() : likesNumContainer.show()
            } else {
                let likesNum = parseInt(likesNumContainer.text(), 10) + 1;
                likesNumContainer.text(likesNum);
                likesNumContainer.show()
            }

            likeBtn.classList.toggle("liked");
        }

        function likeErorr(likeIcon) {
            $(likeIcon).parent().parent().parent().find('.like-erorr').fadeIn(1000);
            $(likeIcon).parent().parent().parent().find('.like-erorr').fadeOut(1000);
        }

        function cart(cartBtn) {
            let productId = cartBtn.dataset.product;
            let url = "";
            let method = "POST";
            if (!$(cartBtn).hasClass('liked')) {
                url = `cart`;
            } else {
                url = `cart/${productId}`;
                method = "DELETE";
            }
            $.ajax({
                url: url,
                method: method,
                dataType: 'JSON',
                data: {
                    _token: CSRF_TOKEN,
                    "product_id": cartBtn.dataset.product,
                    "cart_id": cartBtn.dataset.cart,
                    "total": cartBtn.dataset.price
                },
                success: function(res) {
                    console.log(res);
                    $("#cartQuantity").text(res.cartQuantity);
                    cartBtn.classList.toggle("liked");
                }
            });
        }

        $(document).ready(function() {
            $('.rated').each(function() {
                let i = 1;
                let rating = Math.floor($(this).attr('data-rate'));
                $(this).find("i").each(function() {
                    if (rating >= i) {
                        $(this).addClass('fa-star');
                        i += 1
                    } else {
                        $(this).addClass('fa-star-o');
                    }
                })
            });
        });



        $('.rating_star').on('click', function() {
            var rate = $(this).data('rate');
            $('.rating_star').removeClass('fa-star fa-star-o');
            for (var i = 0; i < rate; i++) {
                $('.rating_star').eq(i).addClass('fa-star');
            }
            for (var i = rate; i < 5; i++) {
                $('.rating_star').eq(i).addClass('fa-star-o');
            }

            $("#rateValue").val(rate);
        });

        $("#reviewForm").spryValidator({
            textarea: {
                isRequired: true,
                validateOn: ['blur'],
                minChars: 20,
                maxChars: 200,
                counterType: "chars_remaining",
                counterId: "my_counter_span",
                hint: "Your message!"
            },
            errorMessages: {
                minChars: "The minimum number of characters is (20)"
            },
            onSuccess: function(event, data, defaults) {
                if (!$('#rateValue').val()) {
                    event.preventDefault();
                    $('#rating_erorr').fadeIn(1000);
                    $('#rating_erorr').fadeOut(1000);
                    return false;
                }
                return true;
            }
        })

        $('.delete').on('click', function() {
            $(this).find('form').submit();
        });

        $('#AddToCart').on('click', function() {
            $.ajax({
                url: '{{ route('cart.store') }}',
                method: 'POST',
                dataType: "json",
                data: {
                    _token: '{{ csrf_token() }}',
                    "product_id": {{ $product->id }},
                },
                statusCode: {
                    409: function() {
                        $('.cartError').fadeIn(1000);
                        $('.cartError').fadeOut(1000);
                    }
                },
                success: function(res) {
                    $("#cartQuantity").text(res.cartQuantity);
                    $('.cartSuccess').fadeIn(1000);
                    $('.cartSuccess').fadeOut(1000);
                }
            });
        });
    </script>
@endpush

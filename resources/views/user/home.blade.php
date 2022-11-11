@extends('layouts.app')
@push('styles')
    <style>
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
    </style>
@endpush
@section('content')
    <!-- slider -->
    <div class="slider">
        <div class="owl-carousel owl-one owl-theme">
            {{-- {{ dd($sliders[1]->product) }} --}}
            @if (count($sliders) > 0)
                @foreach ($sliders as $slider)
                    <div class="item">
                        <div class="slider-img">
                            <img style="height: 100% !impodrtant;" src="{{ asset("slider-images/slider_$slider->id.jpg") }}"
                                alt="">
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-sm-6 col-xs-12">
                                    <div class="slider-captions">
                                        @if ($slider->product !== null)
                                            <div class="brand-img">
                                                <img src="./images/mi_logo.png" alt="">
                                            </div>
                                            <h1 class="slider-title">
                                                {{ $slider->product->brand }}
                                                <span>{{ $slider->product->name }}</span>
                                            </h1>
                                            <p class="hidden-xs">
                                                {{ $slider->product->storage }}
                                                Storage | {{ $slider->product->ram }}GB Ram |
                                                {{ $slider->product->sim_card }}
                                                Sim Card
                                                <br>
                                                {{ $slider->product->processor }} Processor
                                            </p>
                                            <p class="slider-price">${{ $slider->product->price }} </p>
                                            <a href="products/{{ $slider->product->id }}"
                                                class="btn btn-primary btn-lg hidden-xs">Buy Now</a>
                                        @else
                                            <div class="brand-img">
                                                <img src="./images/mi_logo.png" alt="">
                                            </div>
                                            <h1 class="slider-title">Red Mi <span>Y1</span></h1>
                                            <p class="hidden-xs">LED Selfie-light | Fingerprint sensor | Dedicated
                                                microSD
                                                card
                                                slot Snapdragon 435 octa-core processor </p>
                                            <p class="slider-price">$138.99 </p>
                                            <a href="#" class="btn btn-primary btn-lg hidden-xs">Buy Now</a>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <!-- /.slider -->
    <!-- mobile showcase -->
    <div class="space-medium">
        <div class="container">
            <div class="row">
                @if (!$brands->isEmpty())
                    @foreach ($brands as $brand)
                        <div
                            class="{{ $brand->brand_order == 2 ? 'col-lg-6 col-md-6' : 'col-lg-3 col-md-3' }} col-sm-12 col-xs-12">
                            <div class="showcase-block {{ $brand->brand_order == 2 ? 'active big_brand' : '' }}">
                                <div class="display-logo ">
                                    <a href="{{ route('filter', ['brand' => [$brand->brand]]) }}"> <img
                                            style="max-height: 100%" src="{{ $brand->brand_lable_image_path }}"
                                            alt=""></a>
                                </div>
                                <div class="showcase-img">
                                    <a href="filter/{{ $brand->brand }}"> <img src="{{ $brand->brand_main_image_path }}"
                                            alt=""></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </div>
    <!-- /.mobile showcase -->
    <!-- latest products -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="box">
                    <div class="box-head">
                        <h3 class="head-title">Latest Product</h3>
                    </div>
                    <div class="box-body">
                        <div class="row latestProducts">
                            <!-- product -->
                            @if (!$products::latestProducts()->isEmpty())
                                @foreach ($products::latestProducts() as $product)
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb30">
                                        <div class="product-block">
                                            <a href="{{ route('show.product', $product->id) }}">
                                                <div class="product-img">
                                                    <img src="{{ $product->main_image }}" alt="">
                                                </div>
                                            </a>

                                            <div class="product-content">
                                                <h5>
                                                    <a href="{{ route('show.product', $product->id) }}"
                                                        class="product-title">
                                                        <span>{{ $product->name }}</span>
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
                                                        data-price="{{ $product->price }}">
                                                        <i class="shopping-icon fa fa-shopping-cart"></i>
                                                    </span>
                                                </div>

                                                <span class="like-erorr none">You have to login first</span>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="noData text-center w-100"> No products to show</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.latest products -->
    <!-- seller products -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="box">
                    <div class="box-head">
                        <h3 class="head-title">Best Seller Product</h3>
                    </div>
                    <div class="box-body">
                        <div class="row latestProducts">
                            <!-- product -->
                            @if (!$products::bestSellerrProducts()->isEmpty())
                                @foreach ($products::bestSellerrProducts() as $product)
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb30">
                                        <div class="product-block">
                                            <a href="{{ route('show.product', $product->id) }}">
                                                <div class="product-img">
                                                    <img src="{{ $product->main_image }}" alt="">
                                                </div>
                                            </a>

                                            <div class="product-content">
                                                <h5>
                                                    <a href="{{ route('show.product', $product->id) }}"
                                                        class="product-title">
                                                        <span>{{ $product->name }}</span>
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
                                                        data-price="{{ $product->price }}">
                                                        <i class="shopping-icon fa fa-shopping-cart"></i>
                                                    </span>
                                                </div>

                                                <span class="like-erorr none">You have to login first</span>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="noData text-center w-100"> No products to show</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.seller products -->
    <!-- featured products -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="box">
                    <div class="box-head">
                        <h3 class="head-title">Highline</h3>
                    </div>
                    <div class="box-body">
                        <div class="row latestProducts">
                            <!-- product -->
                            @if (!$products::highlineProducts()->isEmpty())
                                @foreach ($products::highlineProducts() as $product)
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb30">
                                        <div class="product-block">
                                            <a href="{{ route('show.product', $product->id) }}">
                                                <div class="product-img">
                                                    <img src="{{ $product->main_image }}" alt="">
                                                </div>
                                            </a>

                                            <div class="product-content">
                                                <h5>
                                                    <a href="{{ route('show.product', $product->id) }}"
                                                        class="product-title">
                                                        <span>{{ $product->name }}</span>
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
                                                        data-price="{{ $product->price }}">
                                                        <i class="shopping-icon fa fa-shopping-cart"></i>
                                                    </span>
                                                </div>

                                                <span class="like-erorr none">You have to login first</span>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="noData text-center w-100"> No products to show</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.featured products -->

    <!-- features -->
    <div class="bg-default pdt40 pdb40">
        <div class="container">
            <div class="row">
                <!-- features -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="feature-left">
                        <div class="feature-outline-icon">
                            <i class="fa fa-credit-card"></i>
                        </div>
                        <div class="feature-content">
                            <h3 class="text-white">Safe Payment</h3>
                            <p>Praesent orci dolor, pretium vitae hendrerit convallisutes orcgravida bibendum.</p>
                        </div>
                    </div>
                </div>
                <!-- features -->
                <!-- features -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="feature-left">
                        <div class="feature-outline-icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="feature-content">
                            <h3 class="text-white">24/7 Help Center</h3>
                            <p>Aliquam molestie urnased one pharetra vestibulum Interdum et malesuada fames.</p>
                        </div>
                    </div>
                </div>
                <!-- features -->
                <!-- features -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="feature-left feature-circle">
                        <div class="feature-outline-icon">
                            <i class="fa fa-rotate-left "></i>
                        </div>
                        <div class="feature-content">
                            <h3 class="text-white">Free &amp; Easy Return</h3>
                            <p>Vivamus semper nisnesbla accumsan dui justo esw finibus turpis serom.</p>
                        </div>
                    </div>
                </div>
                <!-- features -->
                <!-- features -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="feature-left">
                        <div class="feature-outline-icon">
                            <i class="fa fa-dollar"></i>
                        </div>
                        <div class="feature-content">
                            <h3 class="text-white">Great Value</h3>
                            <p>Morbi necmi turpiulm tristiq ueipsm inodiopharetr amal esuat erdumetalesuada.</p>
                        </div>
                    </div>
                </div>
                <!-- features -->
            </div>
        </div>
    </div>
    <!-- /.features -->

    @push('scripts')
        <script src={{ asset('js/owl.carousel.min.js') }}></script>
        <script src={{ asset('js/multiple-carousel.js') }}></script>
        <script>
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
        </script>
    @endpush
@endsection

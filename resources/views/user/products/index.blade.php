@extends('layouts.app')

@push('styles')
    {{-- <link rel="stylesheet" href="{{ asset('css/user/products/show.css') }}"> --}}

    <style>
        a.page-link,
        span.page-link {
            font-size: large !important;
            padding: 10px !important;
            line-height: 1 !important;
            margin: 5px !important;
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

        .btn_filter {
            background: #0cafe5;
            border: 1px solid #e5e5e5;
            border-radius: 5px;
            padding: 8px 10px;
            color: #fff;
            font-size: 14px;
            margin: 10px 0;
            font-weight: 700;
            font-size: 20px
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
                            <li><a href="{{ route('welcome') }}">Home</a></li>
                            <li>Product List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.page-header-->
    <!-- product-list -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <form action="{{ route('filter') }}" method="GET">
                        <!-- sidenav-section -->
                        <div id='cssmenu'>
                            <ul>
                                <li class='has-sub'><a href='#'>CATEGORY
                                        (<span>{{ count($product_details->getAllProductCategories()) }}</span>)</a>
                                    <ul class="filterUl">
                                        @foreach ($product_details->getAllProductCategories() as $key => $category)
                                            <li>
                                                <label>
                                                    <input name='category[]' value='{{ $key }}' type="checkbox"
                                                        {{ @$response['category'][$key - 1] ? 'checked' : '' }}>
                                                    <span class="checkbox-list">{{ $category }} </span>
                                                </label>

                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class='has-sub'><a href='#'>Brand
                                        (<span>{{ count($product_details->getAllProductBrands()) }}</span>)</a>
                                    <ul class="filterUl">
                                        @foreach ($product_details->getAllProductBrands() as $key => $brand)
                                            <li>
                                                <label>
                                                    <input name='brand[]' value='{{ $key }}' type="checkbox"
                                                        {{ @$response['brand'] ? (in_array($key, @$response['brand']) ? 'checked' : '') : '' }}>
                                                    <span class="checkbox-list">{{ $brand }}
                                                </label>

                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class='has-sub'><a href='#'>Price (<span>6</span>)</a>
                                    <ul class="filterUl">
                                        <li>
                                            <label>
                                                <input name="price[]" value="500" type="checkbox"
                                                    {{ @$response['price'] ? (in_array(500, @$response['price']) ? 'checked' : '') : '' }}>
                                                <span class="checkbox-list">500-1000</span>
                                            </label>
                                        </li>
                                        <li><span>
                                                <label>
                                                    <input name="price[]" value="1000" type="checkbox"
                                                        {{ @$response['price'] ? (in_array(1000, @$response['price']) ? 'checked' : '') : '' }}>
                                                    <span class="checkbox-list">1000-2000</span>
                                                </label>
                                        </li>
                                        <li>
                                            <label>
                                                <input name="price[]" value="2000" type="checkbox"
                                                    {{ @$response['price'] ? (in_array(2000, @$response['price']) ? 'checked' : '') : '' }}>
                                                <span class="checkbox-list">2000-4000</span>
                                            </label>
                                        </li>
                                        <li>
                                            <label>
                                                <input name="price[]" value="4000" type="checkbox"
                                                    {{ @$response['price'] ? (in_array(4000, @$response['price']) ? 'checked' : '') : '' }}>
                                                <span class="checkbox-list">4000-8000</span>
                                            </label>
                                        </li>
                                        <li>
                                            <label>
                                                <input name="price[]" value="8000" type="checkbox"
                                                    {{ @$response['price'] ? (in_array(8000, @$response['price']) ? 'checked' : '') : '' }}>
                                                <span class="checkbox-list">8000-16000</span>
                                            </label>
                                        </li>
                                        <li>
                                            <label>
                                                <input name="price[]" value="16000" type="checkbox"
                                                    {{ @$response['price'] ? (in_array(16000, @$response['price']) ? 'checked' : '') : '' }}>
                                                <span class="checkbox-list">16000-32000</span>
                                            </label>
                                        </li>
                                        <li>
                                            <label>
                                                <input name="price[]" value="32000" type="checkbox"
                                                    {{ @$response['price'] ? (in_array(32000, @$response['price']) ? 'checked' : '') : '' }}>
                                                <span class="checkbox-list">Above-32000</span>
                                            </label>
                                        </li>
                                    </ul>
                                </li>
                                <li class='has-sub'><a href='#'>Ordered By (<span>3</span>)</a>
                                    <ul class="filterUl">
                                        <li>
                                            <label>
                                                <input name="sort" value="" type="radio" checked>
                                                <span class="radio-list">Rundom</span>
                                            </label>
                                        </li>
                                        <li>
                                            <label>
                                                <input name="sort" value="desc" type="radio"
                                                    {{ @$response['sort'] == 'desc' ? 'checked' : '' }}>
                                                <span class="radio-list">High Price</span>
                                            </label>
                                        </li>
                                        <li>
                                            <label>
                                                <input name="sort" value="asc" type="radio"
                                                    {{ @$response['sort'] == 'asc' ? 'checked' : '' }}>
                                                <span class="radio-list">Low Price</span>
                                            </label>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <button id="filterSubmit" type="submit" class="btn_filter">Filter</button>
                        </div>
                        <!-- /.sidenav-section -->
                    </form>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                    <div class="row">
                        @if (!$products->isEmpty())
                            @foreach ($products as $product)
                                <!-- product -->
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-bottom:30px">
                                    <div class="product-block">
                                        <a href="{{ route('show.product', $product->id) }}">
                                            <div class="product-img">
                                                <img src="{{ $product->main_image }}" alt="">
                                            </div>
                                        </a>

                                        <div class="product-content">
                                            <h5>
                                                <a href="{{ route('show.product', $product->id) }}" class="product-title">
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
                                                    class="icon_holder @auth {{ $product->carts()->where(['user_id' => auth()->user()->id], ['product_id' => $product->id])->exists()? 'liked': '' }} @endauth"
                                                    onclick={{ auth()->user() ? 'cart(this)' : 'likeErorr(this)' }}
                                                    data-product="{{ $product->id }}">
                                                    <i class="shopping-icon fa fa-shopping-cart"></i>
                                                </span>
                                            </div>

                                            <span class="like-erorr none">You have to login first</span>

                                        </div>
                                    </div>
                                </div>
                                <!-- /.product -->
                            @endforeach
                        @else
                            <div class="no_products" style="position:absolute; top:33%; left:33%;">
                                No products match your filters
                            </div>
                        @endif

                    </div>
                    {{ $products->links('pagination::bootstrap-4') }}

                </div>
            </div>
        </div>
    </div>
    <!-- /.product-list -->
@endsection

@push('scripts')
    <script src={{ asset('js/owl.carousel.min.js') }}></script>
    <script src={{ asset('js/multiple-carousel.js') }}></script>
    <script>
        $(document).ready(function() {
            // hide the numbers of likes if equal 0
            $('.likesNum').each(function() {
                this.innerText == 0 ? this.style.display = "none" : this.style.display = "unset";
            });
        });
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

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
    </script>
    <script>
        (function($) {
            $(document).ready(function() {
                $('#cssmenu ul ul li:odd').addClass('odd');
                $('#cssmenu ul ul li:even').addClass('even');
                $('#cssmenu > ul > li > a').click(function() {
                    $('#cssmenu li').removeClass('active');
                    $(this).closest('li').addClass('active');
                    var checkElement = $(this).next();
                    if ((checkElement.is('ul')) && (checkElement.is(':visible'))) {
                        $(this).closest('li').removeClass('active');
                        checkElement.slideUp('normal');
                    }
                    if ((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
                        $('#cssmenu ul ul:visible').slideUp('normal');
                        checkElement.slideDown('normal');
                    }
                    if ($(this).closest('li').find('ul').children().length == 0) {
                        return true;
                    } else {
                        return false;
                    }
                });
            });
        })(jQuery);
    </script>
@endpush

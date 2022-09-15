@extends('layouts.app')

@push('styles')
    {{-- <link rel="stylesheet" href="{{ asset('css/cart.css') }}"> --}}

    <style>
        td>a>img {
            width: 100px;
            height: 100px;
        }

        .textfieldRequiredState .textfieldRequiredMsg,
        .textfieldInvalidFormatState .textfieldInvalidFormatMsg,
        .textfieldMinValueState .textfieldMinValueMsg,
        .textfieldMaxValueState .textfieldMaxValueMsg,
        .textfieldMinCharsState .textfieldMinCharsMsg,
        .textfieldMaxCharsState .textfieldMaxCharsMsg,
        .textfieldMinAlphaCharsState .textfieldMinAlphaCharsMsg,
        .textfieldMaxAlphaCharsState .textfieldMaxAlphaCharsMsg,
        .textfieldStartAlphaCharsState .textfieldStartAlphaCharsMsg,
        .selectRequiredState .selectRequiredMsg,
        .selectInvalidState .selectInvalidMsg,
        .textareaRequiredState .textareaRequiredMsg,
        .textareaMinCharsState .textareaMinCharsMsg,
        .textareaMaxCharsState .textareaMaxCharsMsg,
        .checkboxRequiredState .checkboxRequiredMsg,
        .checkboxMinSelectionsState .checkboxMinSelectionsMsg,
        .checkboxMaxSelectionsState .checkboxMaxSelectionsMsg,
        .radioRequiredState .radioRequiredMsg,
        .radioInvalidState .radioInvalidMsg,
        .passwordRequiredState .passwordRequiredMsg,
        .passwordMinCharsState .passwordMinCharsMsg,
        .passwordMaxCharsState .passwordMaxCharsMsg,
        .passwordInvalidStrengthState .passwordInvalidStrengthMsg,
        .passwordCustomState .passwordCustomMsg,
        .confirmRequiredState .confirmRequiredMsg,
        .confirmInvalidState .confirmInvalidMsg {
            display: inline;

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
                            <li>Wishlist</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /.page-header-->
    <!-- cart-section -->
    <div class="space-medium">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-head">
                            <h3 class="head-title">My Wishlist (<span id="productsNum">{{ $likes->count() }}</span>)
                            </h3>
                        </div>
                        <!-- cart-table-section -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <div class="cart">
                                    <table class="table table-bordered ">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <span>Item</span>
                                                </th>
                                                <th>
                                                    <span>Price</span>
                                                </th>
                                                <th>
                                                    <span>Remove</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        @if (!$likes->isEmpty())
                                            <tbody id="spry">
                                                @foreach ($likes as $like)
                                                    <tr id="{{ $like->id }}">
                                                        <td>
                                                            <a href="products/{{ $like->product_id }}">
                                                                <img src="{{ $product::getProduct($like->product_id)->main_image }}"
                                                                    alt="product main image">
                                                            </a>
                                                            <span style="margin-left:10px">
                                                                <a href="products/{{ $like->product_id }}">
                                                                    {{ $product::getProduct($like->product_id)->brand }}
                                                                    {{ $product::getProduct($like->product_id)->name }}
                                                                </a>
                                                            </span>
                                                        </td>
                                                        <td>$<span class="price">
                                                                {{ $product::getProduct($like->product_id)->price }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <a data-product="{{ $like->product_id }}"
                                                                onclick="likeFunction(this)" style="margin-left:13%"
                                                                href="javascript:void(0)" class="btn-close delete">
                                                                <i class="fa fa-times-circle-o"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                    </table>
                                @else
                                    </table>
                                    <div class="alert alert-danger">
                                        <strong>No products in your wishlist</strong>
                                    </div>
                                    @endif
                                    <div id="noProducts" style="display:none !important;" class="alert alert-danger">
                                        <strong>No products in your wishlist</strong>
                                    </div>
                                </div>
                                <!-- /.cart-table-section -->
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('home') }}" class="btn-link"><i class="fa fa-angle-left"></i> back to shopping</a>
                </div>

            </div>
        </div>
    </div>
    <!-- /.cart-section -->

    @push('scripts')
        <script>
            function likeFunction(likeBtn) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                let productId = likeBtn.dataset.product;
                let url = `dislike/${productId}`;
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                    },
                    dataType: 'JSON',
                    success: function(res) {
                        $(likeBtn).parents('tr').first().remove();

                        if ($('#spry').children("tr").length == 0) {
                            $('#noProducts').show(1000);
                        }
                    }
                });
            }
        </script>
    @endpush
@endsection

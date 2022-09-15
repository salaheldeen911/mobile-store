@extends('layouts.app')

@push('styles')
    {{-- <link rel="stylesheet" href="{{ asset('css/cart.css') }}"> --}}

    <style>
        td>a>img {
            width: 100px;
            height: 100px;
        }

        .none {
            display: none;
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
                            <li>Cart</li>
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
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="box">
                        <div class="box-head">
                            <h3 class="head-title">My Cart (<span id="productsNum">{{ $cart->products->count() }}</span>)
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
                                                    <span>Quantity</span>
                                                </th>
                                                <th>
                                                    <span>Total</span>
                                                </th>
                                                <th>
                                                    <span>Remove</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        @if (!empty($cart->products->toArray()))
                                            <tbody id="spry">
                                                @foreach ($cart->products as $product)
                                                    <tr id="{{ $product->id }}">
                                                        <td>
                                                            <a href="{{ route('show.product', $product->id) }}">
                                                                <img src="{{ asset($product->main_image) }}"
                                                                    alt="product main image">
                                                            </a>
                                                            <span style="margin-left:10px">
                                                                <a href="#">
                                                                    {{ $product->brand }}</a>
                                                            </span>
                                                        </td>
                                                        <td>$<span class="price">{{ $product->price }}</span>
                                                        </td>
                                                        <td>
                                                            <div class="product-quantity">
                                                                <div class="quantity">
                                                                    <input type="number" data-spry="integer"
                                                                        class="productQuantity input-text qty text"
                                                                        step="1" min="1"
                                                                        max="{{ $product->quantity }}" name="quantity"
                                                                        value="{{ $product->pivot->count }}" title="Qty"
                                                                        size="4">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>$<span
                                                                class="amount">{{ $product->getAttributes()['price'] }}</span>
                                                        </td>
                                                        <td>
                                                            <a style="margin-left:13%" href="javascript:void(0)"
                                                                class="btn-close delete">
                                                                <i class="fa fa-times-circle-o"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                    </table>
                                @elseif (empty($cart->products->toArray()))
                                    </table>
                                    <div class="alert alert-danger">
                                        <strong>No products in cart</strong>
                                    </div>
                                    @endif
                                    <div id="noProducts" style="display:none !important;" class="alert alert-danger">
                                        <strong>No products in cart</strong>
                                    </div>
                                </div>
                                <!-- /.cart-table-section -->
                            </div>
                        </div>
                    </div>
                    <a href="#" class="btn-link"><i class="fa fa-angle-left"></i> back to shopping</a>
                </div>

                <!-- cart-total -->
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="box mb30">
                        <div class="box-head">
                            <h3 class="head-title">Price Details</h3>
                        </div>
                        <div class="box-body">
                            <div class=" table-responsive">
                                <div class="pay-amount ">
                                    <table class="table mb20">
                                        <tbody>
                                            <tr>
                                                <th>
                                                    <span>Price ( <span id="totalCount"> {{ $cart->products->count() }}
                                                        </span>
                                                        items)</span>
                                                </th>
                                                <td>$<span id="total_prices">0</span></td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <span>Delivery Charges</span>
                                                </th>
                                                <td>
                                                    <strong class="text-green">Free</strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tbody>
                                            <tr>
                                                <th>
                                                    <span class="mb0" style="font-weight: 700;">Amount
                                                        Payable</span>
                                                </th>
                                                <td style="font-weight:700;color:#1c1e1e; ">$<strong
                                                        id="veryTotalPrices"></strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <a id="checkoutBtn"
                                    href="{{ !empty($cart->products->toArray()) ? '/checkout' : 'javascript:void(0)' }}"
                                    class="btn btn-primary btn-block">Proceed To Checkout</a>
                                <div class="alert alert-danger none checkout_error">no products in your cart</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.cart-total -->
        </div>
    </div>
    <!-- /.cart-section -->

    @push('scripts')
        <script src={{ asset('/js/SpryValidation.min.js') }}></script>
        <script src={{ asset('/js/spryValidator-V1.js') }}></script>
        <script>
            $(document).ready(function() {
                total();
            });

            $("#spry").spryValidator({
                integer: {
                    validateOn: ['change', 'blur'],
                    isRequired: true,
                },
                submitBtn: "#checkoutBtn",
                errorMessages: {
                    maxValue: "Out of stock",
                    minValue: "Invalid Quantity",
                },
                onSuccess: function(event) {
                    if (parseInt($('#productsNum').text()) == 0) {
                        $('.checkout_error').show(1000);
                        $('.checkout_error').hide(1000);
                        event.preventDefault();
                    }
                }
            })

            $('.productQuantity').on('blur', function(event) {
                let _this = $(this);
                var quantity = $(this).val();
                let container = $(this).parents("tr");
                if ($(this).parent().hasClass('textfieldValidState')) {
                    container.find("span.amount").text(quantity * parseInt(container.find("span.price").text()));
                    $.ajax({
                        url: `cart/${container.attr('id')}`,
                        type: 'PUT',
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: container.attr('id'),
                            count: quantity,
                        },
                        success: function(data) {
                            total();
                        }
                    });
                } else {
                    $.ajax({
                        url: `cart/${container.attr('id')}`,
                        type: 'PUT',
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: container.attr('id'),
                            count: 1,
                        },
                        success: function(data) {
                            _this.val('1');
                            _this.focus();
                            _this.blur();
                            total();
                        }
                    });
                }
            });

            function total() {
                let total = 0;
                let totalCount = 0;

                $(".productQuantity").each(function(index, el) {
                    let quantity = 0;
                    let container = $(this).parents("tr");
                    quantity += parseInt($(this).val());
                    container.find("span.amount").text(quantity * parseInt(container.find("span.price").text()));
                    totalCount += parseInt($(this).val())
                });

                $('.amount').each(function() {
                    total += parseInt($(this).text());
                });

                $('#totalCount').text(totalCount);
                $('#total_prices').text(total);
                $('#veryTotalPrices').text(total);

                return total;
            }

            $('.delete').on('click', function(event) {
                event.preventDefault();
                let container = $(this).parents("tr").first();
                let id = container.attr('id');
                $.ajax({
                    url: `cart/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: container.attr('id')
                    },
                    success: function(data) {
                        $("#cartQuantity").text(data.cartQuantity);
                        container.remove();
                        $('#productsNum').text(parseInt($('#productsNum').text()) - 1);
                        if (parseInt($('#productsNum').text()) == 0) {
                            $('#noProducts').show(600);
                        }
                        total();
                    }
                });
            });
        </script>
    @endpush
@endsection

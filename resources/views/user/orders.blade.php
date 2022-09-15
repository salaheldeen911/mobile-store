@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
@endpush
{{-- {{ dd($orders[0]->products[1]->pivot->total) }} --}}

@section('content')
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li><a href="{{ route('welcome') }}">Home</a></li>
                            <li>Orders</li>
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
            @if (!$orders->isEmpty())
                @foreach ($orders as $order)
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <div class="box">
                                <div class="box-head">
                                    <h3 class="head-title">Order ID: (<span
                                            id="productsNum">{{ $order->id }}</span></span>)
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
                                                            <span>Status</span>
                                                        </th>
                                                        <th>
                                                            <span>Total</span>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="spry">
                                                    @foreach ($order->products as $product)
                                                        <tr id="">
                                                            <td>
                                                                <a href="{{ route('show.product', $product->id) }}">
                                                                    <img src="{{ asset($product->main_image) }}"
                                                                        alt="product main image"
                                                                        style="width:100px; height:100px;">
                                                                </a>
                                                                <span style="margin-left:10px">
                                                                    <a href="#"></a>
                                                                </span>
                                                            </td>
                                                            <td>$<span class="price">{{ $product->price }}</span>
                                                            </td>
                                                            <td>
                                                                <div class="product-quantity">
                                                                    <div class="quantity">
                                                                        <p> {{ $product->pivot->count }} </p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="product-quantity">
                                                                    <div class="quantity">
                                                                        <p> {{ $order->status }} </p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>$<span class="amount">{{ $product->pivot->total }}</span>
                                                            </td>

                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.cart-table-section -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- cart-total -->
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="box mb30">
                                <div class="box-head">
                                    <h3 class="head-title">Order Details</h3>
                                </div>
                                <div class="box-body">
                                    <div class=" table-responsive">
                                        <div class="pay-amount ">
                                            <table class="table mb20">
                                                <tbody>
                                                    <tr>
                                                        <th>
                                                            <span>Price ( <span id="totalCount"> {{ $order->total_items }}
                                                                </span>
                                                                items)</span>
                                                        </th>
                                                        <td>$<span id="total_prices">{{ $order->total }}</span></td>
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
                                                                id="veryTotalPrices">{{ $order->total }}</strong></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <hr style="margin: 10px 0">
                                    <h4>Address Details</h4>
                                    <div class="row" style="font-size:15px">
                                        <div class="col-xs-12">
                                            <p><strong> Name: </strong>
                                                {{ $addresses::getOrderAddress($order->address_id)->name }}</p>
                                        </div>
                                        <div class="col-xs-12">
                                            <p><strong> Phone: </strong>
                                                {{ $addresses::getOrderAddress($order->address_id)->phone }} </p>
                                        </div>
                                        <div class="col-xs-12">
                                            <p><strong> City: </strong>
                                                {{ $addresses::getOrderAddress($order->address_id)->city }} </p>
                                        </div>
                                        <div class="col-xs-12">
                                            <p><strong> Address: </strong>
                                                {{ $addresses::getOrderAddress($order->address_id)->address }} </p>
                                        </div>
                                        @if ($addresses::getOrderAddress($order->address_id)->note)
                                            <div class="col-xs-12">
                                                <p><strong> Note: </strong>
                                                    {{ $addresses::getOrderAddress($order->address_id)->note }} </p>
                                            </div>
                                        @endif

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-head">
                                <h3 class="head-title">Orders:</h3>
                            </div>
                            <!-- cart-table-section -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <div class="cart">
                                        <div class="alert alert-danger none checkout_error">You have never placed any orders
                                        </div>

                                    </div>
                                    <!-- /.cart-table-section -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <a href="{{ route('welcome') }}" class="btn-link"><i class="fa fa-angle-left"></i> back to shopping</a>

            <!-- /.cart-total -->
        </div>
    </div>
    <!-- /.cart-section -->


    @push('scripts')
        <script src="{{ asset('js/checkout.js') }}"></script>

        <script src={{ asset('/js/SpryValidation.min.js') }}></script>
        <script src={{ asset('/js/spryValidator-V1.js') }}></script>

        <script>
            $(document).ready(function() {
                let total = 0;
                $('.total').each(function() {
                    $('#veryTotal').text(total += parseInt($(this).text()));
                });
            })

            $("#checkout").spryValidator({
                textarea: {
                    validateOn: ['blur'],
                    maxChars: 200,
                    counterType: "chars_remaining",
                    counterId: "my_counter_span",
                    hint: "Your message!"
                },
                phone_number: {
                    isRequired: true,
                    pattern: "(000) 000-00-000",
                    hint: "(012) 735-42-801"
                },
                none: {
                    isRequired: true,
                },
                username: {
                    isRequired: true,
                    startAlphaChars: 2
                },
                errorMessages: {
                    startAlphaChars: "Your name must start with 2 letters at least",
                },
                onSuccess: function(event, data, defaults) {
                    event.preventDefault();
                }
            })

            $('a.delete').on('click', function() {
                $(this).next('form').submit();
            })
        </script>
    @endpush
@endsection

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
    <!-- checkout -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="box checkout-form">
                        @if (!$address)
                            <!-- checkout - form -->
                            <div class="box-head">
                                <h2 class="head-title"> Fill Out Your Full Address</h2>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <form id="checkout" action="{{ route('createAddress') }}" method="post">
                                        @csrf
                                        <div class="col-sm-8 col-xs-12">
                                            <div class="form-group">
                                                <label class="control-label sr-only" for="name"></label>
                                                <input data-spry="username" name="name" type="text"
                                                    class="form-control" placeholder="Enter Your Full Name" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label class="control-label sr-only" for="phone"></label>
                                                <input data-spry="phone_number" name="phone" type="text"
                                                    class="form-control" placeholder="Enter Mobile Number" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label class="control-label sr-only"> </label>
                                                <select data-spry="select" name="city" class="form-control" required>
                                                    <option value="Alexandria">Alexandria</option>
                                                    <option value="Cairo">Cairo</option>
                                                    <option value="Aswan">Aswan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label class="control-label sr-only"></label>
                                                <input data-spry="none" name="address" type="text" class="form-control"
                                                    placeholder="Full Address" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label class="control-label sr-only" for="textarea"></label>
                                                <textarea id="textarea" data-spry="textarea" class="form-control" name="note" rows="4"
                                                    placeholder="Notes About Your Order"></textarea>
                                                <span id="my_counter_span"></span>
                                            </div>
                                            <button type='submit' name="addressBtn" class="btn btn-primary ">Save Your
                                                Address</button>

                                        </div>
                                    </form>
                                    <!-- /.checkout-form -->
                                </div>
                            </div>
                        @else
                            <div class="box-head">
                                <h2 class="head-title">Your Saved Address</h2>
                                <a style="position:absolute; top:20px; right:60px;" href="javascript:void(0)"
                                    class="btn-close delete">
                                    <i class="fa fa-times-circle-o"></i>
                                </a>
                                <form action="address/{{ $address->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <p><strong> Name: </strong> {{ $address->name }} </p>
                                    </div>
                                    <div class="col-xs-12">
                                        <p><strong> Phone: </strong> {{ $address->phone }} </p>
                                    </div>
                                    <div class="col-xs-12">
                                        <p><strong> City: </strong> {{ $address->city }} </p>
                                    </div>
                                    <div class="col-xs-12">
                                        <p><strong> Address: </strong> {{ $address->address }} </p>
                                    </div>
                                    <div class="col-xs-12">
                                        <p><strong> Note: </strong> {{ $address->note }} </p>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
                <!-- product total -->
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="box mb30">
                        <div class="box-head">
                            <h3 class="head-title">Your Order</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <!-- product total -->

                                <div class="pay-amount ">
                                    <table class="table mb20">
                                        <thead class=""
                                            style="border-bottom: 1px solid #e8ecf0;  text-transform: uppercase;">
                                            <tr>
                                                <th>
                                                    <span>Product</span>
                                                </th>
                                                <th>
                                                    <span>Total</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        @if (!empty($cart->products->toArray()))
                                            <tbody>
                                                @foreach ($cart->products as $product)
                                                    <tr>
                                                        <th>
                                                            <span>{{ $product->brand }}
                                                                {{ $product->name }} X
                                                                {{ $product->pivot->count }}</span>
                                                        </th>
                                                        <td class="total">
                                                            {{ $product->pivot->count * $product->getAttributes()['price'] }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tbody>
                                                <tr>
                                                    <th>
                                                        <span>Amount Payable</span>
                                                    </th>
                                                    <td id="veryTotal"></td>
                                                </tr>
                                            </tbody>
                                    </table>
                                @else
                                    </table>

                                    <p style="text-align:center">No Items in Cart</p>
                                    @endif

                                </div>
                                <!-- /.product total -->
                            </div>
                        </div>
                    </div>
                    @if ($address)
                        <!-- place order -->
                        <div class="box">
                            <div class="box-head">
                                <h3 class="head-title">Check Payment</h3>
                            </div>
                            <div class="box-body">
                                <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store
                                    Postcode.</p>
                                <a href="{{ !empty($cart->products->toArray()) ? route('order') : 'javascript:void(0)' }}"
                                    class="btn btn-default btn-block">Place Order</a>
                            </div>
                        </div>
                        <!-- /.place order -->
                    @endif

                </div>
            </div>
        </div>
    </div>


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
                onSuccess: function(event) {
                    console.log(event);
                }
            })

            $('a.delete').on('click', function() {
                $(this).next('form').submit();
            })
        </script>
    @endpush
@endsection

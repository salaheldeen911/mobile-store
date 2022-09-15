@extends('layouts.admin-app')

@push('styles')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.3.1/animate.min.css">
    <!-- This is for wow -->
@endpush

@section('admin-content')

    <!-- Page Content -->
    <div class="row">
        <div class="col-lg-8 p-r-0 title-margin-right">
            <div class="page-header">
                <div class="page-title">
                    <h1>Hello,
                        <span>Welcome Here</span>
                    </h1>
                </div>
            </div>
        </div>
        <!-- /# column -->
        <div class="col-lg-4 p-l-0 title-margin-left">
            <div class="page-header">
                <div class="page-title">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.home') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a style="display:inline;" href="{{ route('admin.products.index') }}">Products</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $product->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /# column -->
    </div>
    <!-- /# row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="user-photo m-b-30">
                                <a data-fancybox="product" href="{{ asset($product->main_image) }}" class="item-link">
                                    <img class="img-fluid" src="{{ asset($product->main_image) }}" alt="" />
                                </a>
                                @if ($product->subImages)
                                    @foreach ($product->subImages as $subImage)
                                        <a style="display: none;" data-fancybox="product"
                                            href="{{ asset($subImage->sub_image) }}">
                                            <img src="{{ asset($subImage->sub_image) }}" alt="{{ asset($product->name) }}">
                                        </a>
                                    @endforeach
                                @endif

                            </div>

                            <div class="user-work">
                                <h4>Other informations</h4>
                                <div class="work-content">
                                    <h3>Operating system</h3>
                                    <p>{{ $product->operating_system }}</p>
                                </div>
                                <div class="work-content">
                                    <h3>Sim_Card</h3>
                                    <p>{{ $product->sim_card }}</p>
                                </div>
                                <div class="work-content">
                                    <h3>Sim_Card</h3>
                                    <p>{{ $product->sim_card }}</p>
                                </div>

                                <div class="work-content">
                                    <h3>Year</h3>
                                    <p>{{ $product->year }}</p>
                                </div>
                            </div>
                            <div class="user-skill">
                                <h4>Skills</h4>
                                <ul>
                                    <li>
                                        <a href="#">HTML</a>
                                    </li>
                                    <li>
                                        <a href="#">CSS</a>
                                    </li>
                                    <li>
                                        <a href="#">SASS</a>
                                    </li>
                                    <li>
                                        <a href="#">JAVASCRIPT</a>
                                    </li>
                                    <li>
                                        <a href="#">JQUERY</a>
                                    </li>
                                    <li>
                                        <a href="#">VUEJS</a>
                                    </li>
                                    <li>
                                        <a href="#">PHP</a>
                                    </li>
                                    <li>
                                        <a href="#">LARAVEL</a>
                                    </li>
                                    <li>
                                        <a href="#">GIT</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="user-profile-name">{{ "$product->brand $product->name" }}</div>

                            <div class="ratings">
                                <h4>Ratings</h4>
                                <div id="ratingStars" class="rating-star"
                                    data-rate="{{ floor($product->ratings->pluck('rating')->avg()) }}">
                                    <span>{{ $product->ratings->pluck('rating')->avg() ?? '0' }} / 5</span>
                                    <i class="ti-star"></i>
                                    <i class="ti-star"></i>
                                    <i class="ti-star"></i>
                                    <i class="ti-star"></i>
                                    <i class="ti-star"></i>
                                </div>
                            </div>
                            <div class="user-send-message">
                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                    class="btn btn-primary btn-addon" type="button">
                                    <i class="ti-email"></i>Edit</a>
                            </div>
                            <div class="custom-tab user-profile-tab">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#1" aria-controls="1" role="tab" data-toggle="tab">About</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="1" role="tabpanel" class="tab-pane active">
                                        <div class="basic-information">
                                            <h4>Admin information</h4>
                                            <div class="gender-content">
                                                <span class="contact-title">Sold:</span>
                                                <span class="gender">{{ $product->sold }}</span>
                                            </div>
                                            <div class="gender-content">
                                                <span class="contact-title">Quantity:</span>
                                                <span class="gender">{{ $product->quantity }}</span>
                                            </div>
                                            <div class="gender-content">
                                                <span class="contact-title">Published By:</span>
                                                <span class="gender">{{ $product->user->name }}</span>
                                            </div>
                                            <div class="gender-content">
                                                <span class="contact-title">Old_Price:</span>
                                                <span class="gender">{{ $product->old_price }}</span>
                                            </div>
                                            <div class="gender-content">
                                                <span class="contact-title">Price:</span>
                                                <span class="gender">{{ $product->price }}</span>
                                            </div>
                                            <div class="gender-content">
                                                <span class="contact-title">Published Date:</span>
                                                <span class="gender">{{ $product->created_at }}</span>
                                            </div>
                                        </div>
                                        <div class="basic-information">
                                            <h4>Main information</h4>
                                            <div class="birthday-content">
                                                <span class="contact-title">Storage:</span>
                                                <span class="birth-date">{{ $product->storage }}</span>
                                            </div>
                                            <div class="birthday-content">
                                                <span class="contact-title">Battery:</span>
                                                <span class="birth-date">{{ $product->battery }}</span>
                                            </div>
                                            <div class="gender-content">
                                                <span class="contact-title">Color:</span>
                                                <span class="gender">{{ $product->color }}</span>
                                            </div>
                                            <div class="gender-content">
                                                <span class="contact-title">Sim_Card:</span>
                                                <span class="gender">{{ $product->sim_card }}</span>
                                            </div>
                                            <div class="gender-content">
                                                <span class="contact-title">Screen Size:</span>
                                                <span class="gender">{{ $product->screen_size }} inch </span>
                                            </div>
                                            <div class="gender-content">
                                                <span class="contact-title">Processor:</span>
                                                <span class="gender">{{ $product->processor }} </span>
                                            </div>
                                            <div class="gender-content">
                                                <span class="contact-title">Front Camera:</span>
                                                <span class="gender">{{ $product->front_camera }} </span>
                                            </div>
                                            <div class="gender-content">
                                                <span class="contact-title">Main Camera:</span>
                                                <span class="gender">{{ $product->main_camera }}</span>
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
    </div>

@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script>
        $(document).ready(function() {
            let i = 1;
            let rating = Math.floor($("#ratingStars").attr('data-rate'));
            $("#ratingStars").find("i").each(function() {
                if (rating >= i) {
                    $(this).addClass('color-primary');
                    i += 1
                }
            })
        });
    </script>
@endpush

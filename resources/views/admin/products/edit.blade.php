@extends('layouts.admin-app')

@push('styles')
    <style>
        @media (min-width: 768px) {
            .left_side {
                box-shadow: unset;
            }
        }

        .row {
            display: flex;
            position: relative;
        }

        textarea {
            height: 85px !important;
        }

        .description {
            padding: 15px;
        }

        .left_side {
            box-shadow: 2px 0 3px -2px grey;
        }

        .w-100 {
            width: 100%;
        }

        .form-group {
            display: flex;
            align-items: center;
            position: relative;
            height: 55px;
        }

        label {
            width: 30%;
            margin-left: 3px
        }

        .input_holder {
            width: 70%;
            height: 50px;
        }

        .identifier {
            position: absolute;
            right: 40px;
        }
    </style>
@endpush

@section('admin-content')
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
                    <li class="breadcrumb-item active">Edit product: {{ $product->id }}</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div style="margin-top: 26px" class="card">
                    <div class="card-header">{{ __('Add Product') }}</div>

                    <div class="card-body">
                        <div id="basicContainer" style="display: none" class="image">
                            <span onclick="clickUpload(this)" class="img-label">{{ __('Add image') }}</span>
                            <input class="image-input" type="file" accept="image/*" onchange="Checkfiles(this)"
                                name="subImage[]">
                        </div>
                        <form id="createProduct" novalidate method="POST" action="/admin/products/{{ $product->id }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row" style="border-bottom: 1px solid #c4c4c4;">
                                <div class="left_side col-md-7">

                                    <div class="form-group">
                                        <label for="name" class="">{{ __('Name') }}</label>
                                        <div class="input_holder">
                                            <input id="name" data-spry='username' type="text"
                                                value="{{ $product->name }}"
                                                class="form-control input-default  @error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name') }}" autofocus>
                                        </div>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="brand">{{ __('Brand') }}</label>
                                        <div class="input_holder">
                                            <select id="brand" name="brand"
                                                class="form-control @error('brand') is-invalid @enderror"
                                                data-spry="select">
                                                <option disabled selected value="-1"> -- Select A Brand -- </option>
                                                @foreach ($product_details::getAllProductBrands() as $key => $brand)
                                                    <option
                                                        {{ $key == $product->getRawOriginal('brand') ? 'selected' : '' }}
                                                        value="{{ $key }}">{{ $brand }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('brand')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="category">{{ __('Category') }}</label>
                                        <div class="input_holder">
                                            <select id="category" name="category"
                                                class="form-control @error('category') is-invalid @enderror"
                                                data-spry="select">
                                                <option disabled selected value='-1'> -- Select A Category -- </option>
                                                @foreach ($product_details->getAllProductCategories() as $key => $category)
                                                    <option
                                                        {{ $key == $product->getRawOriginal('category') ? 'selected' : '' }}
                                                        value="{{ $key }}">{{ $category }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('category')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="phone_type">{{ __('Phone Type') }}</label>
                                        <div class="input_holder">
                                            <select id="phone_type" name="phone_type"
                                                class="form-control @error('phone_type') is-invalid @enderror"
                                                data-spry="select">
                                                <option disabled selected value='-1'> -- Select A Phone Type --
                                                </option>

                                                @foreach ($product_details->getAllProductTypes() as $key => $type)
                                                    <option
                                                        {{ $key == $product->getRawOriginal('phone_type') ? 'selected' : '' }}
                                                        value="{{ $key }}">{{ $type }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        @error('phone_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="sim_card">{{ __('Sim Card') }}</label>
                                        <div class="input_holder">
                                            <select id="sim_card" name="sim_card"
                                                class="form-control @error('sim_card') is-invalid @enderror"
                                                data-spry="select">
                                                <option disabled selected value='-1'> -- Select Sim_Card Type --
                                                </option>

                                                @foreach ($product_details->getAllProductSimCards() as $key => $simCard)
                                                    <option
                                                        {{ $key == $product->getRawOriginal('sim_card') ? 'selected' : '' }}
                                                        value="{{ $key }}">{{ $simCard }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        @error('sim_card')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="quantity">{{ __('Quantity') }}</label>
                                        <div class="input_holder">
                                            <input id="quantity" data-spry='integer' type="number" max="50"
                                                min="1" class="form-control @error('quantity') is-invalid @enderror"
                                                name="quantity" value="{{ $product->quantity }}">
                                        </div>
                                        @error('quantity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="operating_system">{{ __('Operating System') }}</label>
                                        <div class="input_holder">
                                            <select id="operating_system" name="operating_system"
                                                class="form-control @error('operating_system') is-invalid @enderror"
                                                data-spry="select">
                                                <option disabled selected value='-1'> -- Select Operating System --
                                                </option>

                                                @foreach ($product_details->getAllProductOperatingSystems() as $key => $operatingSystem)
                                                    <option
                                                        {{ $key == $product->getRawOriginal('operating_system') ? 'selected' : '' }}
                                                        value="{{ $key }}">{{ $operatingSystem }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        @error('operating_system')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="processor">{{ __('Processor') }}</label>
                                        <div class="input_holder">
                                            <select id="processor" name="processor"
                                                class="form-control @error('processor') is-invalid @enderror"
                                                data-spry="select">
                                                <option disabled selected value='-1'> -- Select Processor -- </option>
                                                <option value="Snapdragon 778G"
                                                    {{ $product->processor == 'Snapdragon 778G' ? 'selected' : '' }}>
                                                    Snapdragon 778G </option>
                                            </select>
                                        </div>
                                        @error('processor')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="screen_protection">{{ __('Screen Protection') }}</label>
                                        <div class="input_holder">
                                            <select id="screen_protection" name="screen_protection"
                                                class="form-control @error('screen_protection') is-invalid @enderror"
                                                data-spry="select">
                                                <option disabled selected value='-1'> -- Select Screen Protection --
                                                </option>

                                                @foreach ($product_details->getAllProductScreenProtections() as $key => $screenProtection)
                                                    <option
                                                        {{ $key == $product->getRawOriginal('screen_protection') ? 'selected' : '' }}
                                                        value="{{ $key }}">{{ $screenProtection }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        @error('screen_protection')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="body_material">{{ __('Body Material') }}</label>
                                        <div class="input_holder">
                                            <select id="body_material" name="body_material"
                                                class="form-control @error('body_material') is-invalid @enderror"
                                                data-spry="select">
                                                <option disabled selected value='-1'> -- Body Material -- </option>

                                                @foreach ($product_details->getAllProductBodyMaterials() as $key => $material)
                                                    <option
                                                        {{ $key == $product->getRawOriginal('body_material') ? 'selected' : '' }}
                                                        value="{{ $key }}">{{ $material }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        @error('body_material')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="color">{{ __('Color') }}</label>
                                        <div class="input_holder">
                                            <select id="color" name="color"
                                                class="form-control @error('color') is-invalid @enderror"
                                                data-spry="select">
                                                <option disabled selected value='-1'> -- Select Phone Color --
                                                </option>

                                                @foreach ($product_details->getAllProductColors() as $key => $color)
                                                    <option
                                                        {{ $key == $product->getRawOriginal('color') ? 'selected' : '' }}
                                                        value="{{ $key }}">{{ $color }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        @error('color')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="right_side col-md-5">

                                    <div class="form-group">
                                        <label for="storage">{{ __('Storage') }}</label>
                                        <div class="input_holder">


                                            <select id="storage" name="storage"
                                                class="form-control @error('storage') is-invalid @enderror"
                                                data-spry="select">
                                                <option disabled selected value='-1'> -- Select Storage -- </option>

                                                @foreach ($product_details->getAllProductStorages() as $key => $storage)
                                                    <option
                                                        {{ $key == $product->getRawOriginal('storage') ? 'selected' : '' }}
                                                        value="{{ $key }}">{{ $storage }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        @error('storage')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="ram">{{ __('Ram') }}</label>
                                        <div class="input_holder">
                                            <input id="ram" data-spry='integer' type="number" max="50"
                                                min="1" class="form-control  @error('ram') is-invalid @enderror"
                                                name="ram" value="{{ $product->ram }}">
                                        </div>
                                        <span class="identifier"> GB </span>
                                        @error('ram')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="network">{{ __('Network') }}</label>
                                        <div class="input_holder">

                                            <select id="network" name="network"
                                                class="form-control @error('network') is-invalid @enderror"
                                                data-spry="select">
                                                <option disabled selected value='-1'> -- Select Network -- </option>

                                                @foreach ($product_details->getAllProductNetworks() as $key => $network)
                                                    <option
                                                        {{ $key == $product->getRawOriginal('network') ? 'selected' : '' }}
                                                        value="{{ $key }}">{{ $network }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('network')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="old_price">{{ __('Old Price') }}</label>
                                        <div class="input_holder">
                                            <input id="old_price" data-spry='currency' type="number" max="100000"
                                                min="0"
                                                class="form-control @error('old_price') is-invalid @enderror"
                                                name="old_price" value="{{ $product->getRawOriginal('old_price') }}">
                                        </div>
                                        <span class="identifier"> $ </span>
                                        @error('old_price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="price">{{ __('Now Price') }}</label>
                                        <div class="input_holder">
                                            <input id="price" data-spry='currency' type="number" max="100000"
                                                min="0" class="form-control @error('price') is-invalid @enderror"
                                                name="price" value="{{ $product->getRawOriginal('price') }}">
                                        </div>
                                        <span class="identifier"> $ </span>
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="screen_size">{{ __('Screen Size') }}</label>
                                        <div class="input_holder">
                                            <input id="screen_size" type="number" data-spry='currency'
                                                class="form-control @error('screen_size') is-invalid @enderror"
                                                name="screen_size" value="{{ $product->screen_size }}">
                                        </div>
                                        <span class="identifier"> (Inch) </span>
                                        @error('screen_size')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="battery">{{ __('Battery') }}</label>
                                        <div class="input_holder">
                                            <input id="battery" data-spry='integer' type="number" max="10000"
                                                min="300"
                                                class="form-control @error('battery') is-invalid @enderror"
                                                name="battery" value="{{ $product->battery }}">
                                        </div>
                                        <span class="identifier"> (mAh) </span>
                                        @error('battery')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="main_camera">{{ __('Main Camera') }}</label>
                                        <div class="input_holder">
                                            <input id="main_camera" data-spry='integer' type="number"
                                                class="form-control @error('main_camera') is-invalid @enderror"
                                                name="main_camera" value="{{ $product->getRawOriginal('main_camera') }}">
                                        </div>
                                        <span class="identifier"> MP </span>
                                        @error('main_camera')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="front_camera">{{ __('Front Camera') }}</label>
                                        <div class="input_holder">
                                            <input id="front_camera" data-spry='integer' type="number"
                                                class="form-control @error('front_camera') is-invalid @enderror"
                                                name="front_camera"
                                                value="{{ $product->getRawOriginal('front_camera') }}">
                                        </div>
                                        <span class="identifier"> MP </span>
                                        @error('front_camera')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="year">{{ __('Year') }}</label>
                                        <div class="input_holder">
                                            <select id="year" name="year"
                                                class="form-control @error('year') is-invalid @enderror"
                                                data-spry="select">
                                                <option disabled selected value='-1'> -- Select Year -- </option>

                                                @foreach ($product_details->getAllProductYears() as $key => $year)
                                                    <option
                                                        {{ $key == $product->getRawOriginal('year') ? 'selected' : '' }}
                                                        value="{{ $key }}">{{ $year }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('year')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="fast_charge">{{ __('Fast Charge') }}</label>
                                        <div class="input_holder">
                                            <select id="fast_charge" name="fast_charge"
                                                class="form-control @error('fast_charge') is-invalid @enderror"
                                                data-spry="select">
                                                <option disabled selected value='-1'> -- Select Fast Charge --
                                                </option>

                                                @foreach ($product_details->getAllProductFastChargings() as $key => $fast_charge)
                                                    <option
                                                        {{ $key == $product->getRawOriginal('fast_charge') ? 'selected' : '' }}
                                                        value="{{ $key }}">{{ $fast_charge }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        @error('fast_charge')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="w-100 description">
                                <label class="w-100" for="description">{{ __('Description') }}</label>

                                <div class="w-100">
                                    <textarea id="description" data-spry='textarea'
                                        class="form-control w-100  @error('description') is-invalid @enderror" rows="3" name="description"> {{ $product->description }}</textarea>
                                </div>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div id="imagesContainer" class="container show-images-container">
                                        <div id="mainImage">
                                            <label for="main-image" class="main-image">{{ __('Main image') }}</label>
                                            <input id="main-image" class="image-input" type="file" accept="image/*"
                                                onchange="validatMainImg(this)" name="mainImage">
                                            <input class="old-main" type="hidden" name="oldMainImage"
                                                value="{{ $product->main_image }}">
                                            <div class="main-image-holder">
                                                <img src="{{ asset($product->main_image) }}" alt="">
                                                <div class="icon-container">
                                                    <span class="ti-trash delete-icon" onclick='deleteImage(this)'></span>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($product->subImages)
                                            @foreach ($product->subImages as $subImage)
                                                <div class="image">
                                                    <span for="product-images" style="visibility: hidden !important;"
                                                        onclick="clickUpload(this)"
                                                        class="img-label none">{{ __('Add image') }}</span>
                                                    <input class="image-input" type="file" accept="image/*"
                                                        onchange="Checkfiles(this)" name="subImage[]">

                                                    <input type="hidden" name="oldSubImages[]"
                                                        value="{{ $subImage->id }}">
                                                    <div class="sub-image-holder">
                                                        <img src="{{ asset($subImage->sub_image) }}" alt="">
                                                        <div class="icon-container">
                                                            <span class="ti-trash delete-icon"
                                                                onclick='deleteImage(this)'></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                            @if (count($product->subImages->toArray()) < 3)
                                                <div class="image">
                                                    <span for="product-images" onclick="clickUpload(this)"
                                                        class="img-label">{{ __('Add image') }}</span>
                                                    <input class="image-input" type="file" accept="image/*"
                                                        onchange="Checkfiles(this)" name="subImage[]">
                                                </div>
                                            @endif
                                        @endif
                                    </div>

                                    @error('main-image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <span class="erorr-required-img">The main image is required</span>
                            </div>

                            <div class="row">
                                <div style="margin:0 auto;">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Edit the product') }}
                                    </button>
                                </div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src={{ asset('/js/SpryValidation.min.js') }}></script>
        <script src={{ asset('/js/spryValidator-V1.js') }}></script>
        <script>
            $(document).ready(function() {
                setTimeout(() => {
                    $("#name").focus();
                }, 1500);
            })

            let mainContainer = document.getElementById('imagesContainer')
            let imagContanerClone = document.getElementById("basicContainer");

            $("#createProduct").spryValidator({
                username: {
                    isRequired: true,
                },
                select: {
                    isRequired: true,
                    invalidValue: -1
                },
                integer: {
                    isRequired: true
                },
                currency: {
                    useCharacterMasking: true,
                    isRequired: true,
                    hint: "19.99"
                },
                onSuccess: function(e) {
                    let subImgs = document.querySelectorAll('div.sub-image-holder');
                    let mainImgInput = document.getElementById('main-image');
                    if (!mainImgInput.value) {
                        if (mainImgInput.nextElementSibling) {
                            return true;
                        } else {
                            e.preventDefault();
                            $('.erorr-required-img').fadeIn(1000);
                            $('.erorr-required-img').fadeOut(1000);
                            return false;
                        }
                    }
                    return true;

                    // if (subImgs.length < 4 && subImgs.length !== 0) {
                    //     subImgs[subImgs.length - 1].remove();
                    // }
                }
            })

            function validatMainImg(input) {
                var fileName = input.value;
                var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
                let container = input.parentElement;

                if (ext == "jpg" || ext == "jpeg" || ext == "png") {

                    attachImg(container, input)

                    return true;
                } else {
                    alert("The image extintion must be one of those : jpg, jpeg or png ");
                    input.value = ""
                    return false;
                }
            }


            function clickUpload(label) {
                label.nextElementSibling.click();
            }

            function makeAnother(con, check) {
                let imagesLength = document.querySelectorAll('div.sub-image-holder').length
                if (check) {
                    if (imagesLength <= 1) {
                        mainContainer.appendChild(con);
                        con.style.display = "block";
                    }
                } else {
                    mainContainer.appendChild(con);
                    con.style.display = "block";
                }
            }

            function deleteImage(e) {
                if (e.parentElement.parentElement.previousElementSibling.name == "oldMainImage") {
                    e.parentElement.parentElement.previousElementSibling.remove();
                    e.parentElement.parentElement.previousElementSibling.value = ""
                    e.parentElement.parentElement.remove();
                    imagesLength = mainContainer.children.length
                    return
                } else if (e.parentElement.parentElement.previousElementSibling.name == "mainImage") {
                    e.parentElement.parentElement.previousElementSibling.value = ""
                    e.parentElement.parentElement.remove();
                } else {
                    imagesLength = document.querySelectorAll('div.sub-image-holder').length;
                    if (imagesLength == 3) {
                        e.parentElement.parentElement.parentElement.remove();
                        makeAnother(imagContanerClone.cloneNode(true));
                    } else {
                        e.parentElement.parentElement.parentElement.remove();
                    }

                }
            }

            function attachImg(container, input) {
                let imgHolder = "";
                if (input.nextElementSibling) {
                    if (input.nextElementSibling.tagName == "INPUT") {
                        input.nextElementSibling.remove()
                    }
                }

                if (!input.nextElementSibling) {
                    if (container.id == "mainImage") {
                        imgHolder = `
                            <div class="main-image-holder">
                                <img src="#" alt="">
                                <div class="icon-container">
                                    <span class="ti-trash delete-icon" onclick='deleteImage(this)'></span>
                                </div>
                            </div>`
                    } else {
                        imgHolder = `
                            <div class="sub-image-holder">
                                <img src="#" alt="">
                                <div class="icon-container">
                                    <span class="ti-trash delete-icon" onclick='deleteImage(this)'></span>
                                </div>
                            </div>`;
                    }

                    container.insertAdjacentHTML('beforeend', imgHolder);
                    const [file] = input.files
                    if (file) {
                        input.nextElementSibling.children[0].src = URL.createObjectURL(file)
                    }
                } else {
                    const [file] = input.files
                    if (file) {
                        input.nextElementSibling.children[0].src = URL.createObjectURL(file)
                    }
                }
            }

            function Checkfiles(input) {
                var fileName = input.value;
                var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
                let container = input.parentElement;
                let imagesLength = document.getElementsByClassName('sub-image-holder').length;

                if (ext == "jpg" || ext == "jpeg" || ext == "png") {
                    makeAnother(imagContanerClone.cloneNode(true), true);
                    input.previousElementSibling.style.visibility = "hidden"
                    attachImg(container, input)
                    return true;
                } else {
                    alert("The image extintion must be one of those : jpg, jpeg or png");
                    input.value = ""
                    return false;
                }
            }
        </script>
    @endpush
@endsection






{{-- @extends("admin.layouts.admin-app")

@section('admin-content')
    <div class="col-lg-12 p-l-0 title-margin-left">
        <div class="page-header">
            <div style="float: right" class="page-title">
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
    <div style="display: none" id="basicContainer" class="image">
        <span for="product-images" onclick="clickUpload(this)" class="img-label">{{ __('Add image') }}</span>
        <input class="image-input" type="file" accept="image/*" onchange="Checkfiles(this)" name="subImage[]">
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div style="margin-top: 26px" class="card">
                    <div class="card-header">{{ __('Edit Product') }}</div>
                    <div class="card-body">
                        <form novalidate id="createProduct" method="POST" action="/admin/products/{{ $product->id }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <span for="name" class="col-md-2 col-form-label text-md-center">{{ __('Name') }}</span>

                                <div class="col-md-10">
                                    <input id="name" type="text"
                                        class="form-control input-default  @error('name') is-invalid @enderror" name="name"
                                        value="{{ $product->name }}" required autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <span for="category"
                                    class="col-md-2 col-form-label text-md-center">{{ __('category') }}</span>

                                <div class="col-md-10">
                                    <input id="category" type="text"
                                        class="form-control input-default  @error('category') is-invalid @enderror"
                                        name="category" value="{{ $product->category }}" required>

                                    @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <span for="price" class="col-md-2 col-form-label text-md-center">{{ __('price') }}</span>

                                <div class="col-md-10">
                                    <input id="price" type="number"
                                        class="form-control @error('price') is-invalid @enderror" name="price"
                                        value="{{ $product->price }}" required>

                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <span for="quantity"
                                    class="col-md-2 col-form-label text-md-center">{{ __('quantity') }}</span>
                                <div class="col-md-10">
                                    <input id="quantity" type="number"
                                        class="form-control @error('quantity') is-invalid @enderror" name="quantity"
                                        value="{{ $product->quantity }}">

                                    @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <span for="description"
                                    class="col-md-2 col-form-label text-md-center">{{ __('description') }}</span>

                                <div class="col-md-10">
                                    <textarea class="form-control" id="description" rows="3" name="description">{{ $product->description }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <span class="erorr-requared-img">this image is required</span>

                                    <div id="imagesContainer" class="container show-images-container">

                                        <div id="mainImage">
                                            <span for="main-image" onclick="clickUpload(this)"
                                                class="main-image">{{ __('Main image') }}</span>
                                            <input class="image-input" id="mainImg" type="file" accept="image/*"
                                                onchange="validatMainImg(this)" name="mainImage">

                                            <input class="old-main" type="hidden" name="oldMainImage"
                                                value="{{ $product->main_image }}">
                                            <div class="sub-image-holder">
                                                <img src="{{ asset($product->main_image) }}" alt="">
                                                <div class="icon-container">
                                                    <span class="ti-trash delete-icon" onclick='deleteImage(this)'></span>
                                                </div>
                                            </div>
                                        </div>

                                        @error('main-image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        @if ($product->subImages)
                                            @foreach ($product->subImages as $subImage)
                                                <div class="image">
                                                    <span for="product-images" style="visibility: hidden !important;"
                                                        onclick="clickUpload(this)"
                                                        class="img-label none">{{ __('Add image') }}</span>
                                                    <input class="image-input" type="file" accept="image/*"
                                                        onchange="Checkfiles(this)" name="subImage[]">

                                                    <input type="hidden" name="oldSubImages[]"
                                                        value="{{ $subImage->id }}">
                                                    <div class="sub-image-holder">
                                                        <img src="{{ asset($subImage->sub_image) }}" alt="">
                                                        <div class="icon-container">
                                                            <span class="ti-trash delete-icon"
                                                                onclick='deleteImage(this)'></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                            @if (count($product->subImages->toArray()) < 7)
                                                <div class="image">
                                                    <span for="product-images" onclick="clickUpload(this)"
                                                        class="img-label">{{ __('Add image') }}</span>
                                                    <input class="image-input" type="file" accept="image/*"
                                                        onchange="Checkfiles(this)" name="subImage[]">
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-10 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Edit the product') }}
                                    </button>
                                </div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        let mainContainer = document.getElementById('imagesContainer');
        let imagContanerClone = document.getElementById("basicContainer");

        $('#createProduct').on('submit', function(e) {
            let subImgs = document.querySelectorAll('div.sub-image-holder');
            let mainImgInput = document.getElementById('mainImg');
            if (!mainImgInput.value) {
                if (mainImgInput.nextElementSibling) {
                    return true; // submit the form
                } else {
                    $('.erorr-requared-img').fadeIn(1000);
                    $('.erorr-requared-img').fadeOut(1000);
                    e.preventDefault();
                    return false;
                }
            } else {
                if (subImgs.length < 4 && subImgs.length !== 0) {
                    subImgs[subImgs.length - 1].remove();
                }
                return true; // submit the form
            }
        })

        function validatMainImg(input) {
            // input.nextElementSibling("input").remove();
            var fileName = input.value;
            var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
            let container = input.parentElement;

            if (ext == "jpg" || ext == "jpeg" || ext == "png") {
                // resetBtn.disabled = "disabled";

                attachImg(container, input)
                input.previousElementSibling.previousElementSibling.disabled = "disabled";

                return true;
            } else {
                alert("The image extintion must be one of those : jpg, jpeg or png ");
                input.value = ""
                return false;
            }
        }


        function clickUpload(label) {
            label.nextElementSibling.click();
        }

        function makeAnother(con, check) {
            let imagesLength = document.querySelectorAll('div.sub-image-holder').length
            if (check) {
                if (imagesLength <= 3) {
                    mainContainer.appendChild(con);
                    con.style.display = "block";
                }
            } else {
                mainContainer.appendChild(con);
                con.style.display = "block";
            }
        }

        function deleteImage(e) {
            if (e.parentElement.parentElement.previousElementSibling.name == "oldMainImage") {
                e.parentElement.parentElement.previousElementSibling.remove();
                e.parentElement.parentElement.previousElementSibling.value = ""
                e.parentElement.parentElement.remove();
                imagesLength = mainContainer.children.length
                return
            } else if (e.parentElement.parentElement.previousElementSibling.name == "mainImage"){
                e.parentElement.parentElement.previousElementSibling.value = ""
                e.parentElement.parentElement.remove();
            } else {
                    imagesLength = document.querySelectorAll('div.sub-image-holder').length;
                if (imagesLength == 5) {
                    e.parentElement.parentElement.parentElement.remove();
                    makeAnother(imagContanerClone.cloneNode(true));
                } else {
                    e.parentElement.parentElement.parentElement.remove();
                }

            }
        }

        function attachImg(container, input) {
            if (input.nextElementSibling) {
                if (input.nextElementSibling.tagName == "INPUT") {
                    input.nextElementSibling.remove()
                }
            }

            if (!input.nextElementSibling) {
                let imgHolder = `
                                <div class="sub-image-holder">
                                    <img src="#" alt="">
                                    <div class="icon-container">
                                        <span class="ti-trash delete-icon" onclick='deleteImage(this)'></span>
                                    </div>
                                </div>`;

                container.insertAdjacentHTML('beforeend', imgHolder);
                const [file] = input.files
                if (file) {
                    input.nextElementSibling.children[0].src = URL.createObjectURL(file)
                }
            } else {
                const [file] = input.files
                if (file) {
                    input.nextElementSibling.children[0].src = URL.createObjectURL(file)
                }
            }
        }

        function Checkfiles(input) {
            var fileName = input.value;
            var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
            let container = input.parentElement;
            let imagesLength = document.getElementsByClassName('sub-image-holder').length;

            if (ext == "jpg" || ext == "jpeg" || ext == "png") {
                makeAnother(imagContanerClone.cloneNode(true), true);
                input.previousElementSibling.style.visibility = "hidden"
                attachImg(container, input)
                return true;
            } else {
                alert("The image extintion must be one of those : jpg, jpeg or png");
                input.value = ""
                return false;
            }
        }
    </script>
    @endpush
@endsection --}}

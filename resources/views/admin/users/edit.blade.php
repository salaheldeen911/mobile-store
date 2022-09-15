@extends('layouts.admin-app')

@section('admin-content')

    <div class="col-lg-12 p-l-0 title-margin-right">
        <div class="page-header">
            <div class="page-title">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.home') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a style="display:inline;" href="{{ route('admin.products.index') }}">Products</a>
                    </li>
                    <li class="breadcrumb-item active">Edit user -->> {{ $user->name }}</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div style="margin-top: 26px" class="card">
                    <div class="card-header">{{ __('Edit User') }}</div>

                    <div class="card-body">
                        <form id="createUser" novalidate method="POST" action="/admin/users/{{ $user->id }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="name"
                                    class="col-md-2 col-form-label text-md-center">{{ __('Name') }}</label>

                                <div class="col-md-10">
                                    <input id="name" data-spry='username' value="{{ $user->name }}" type="text"
                                        class="spryValidation form-control input-default  @error('name') is-invalid @enderror"
                                        name="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-2 col-form-label text-md-center">{{ __('email') }}</label>

                                <div class="col-md-10">
                                    <input id="email" value="{{ $user->email }}" data-spry='email' type="email"
                                        class="spryValidation form-control input-default  @error('email') is-invalid @enderror"
                                        name="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-2 col-form-label text-md-center">{{ __('password') }}</label>

                                <div class="col-md-10">
                                    <input id="password" data-spry='password' type="password"
                                        class="spryValidation form-control  @error('password') is-invalid @enderror"
                                        name="password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirmation"
                                    class="col-md-2 col-form-label text-md-center">{{ __('password-confirmation') }}</label>

                                <div class="col-md-10">
                                    <input id="password-confirmation" data-spry='confirm' type="password"
                                        class="spryValidation form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="role"
                                    class="col-md-2 col-form-label text-md-center">{{ __('role') }}</label>

                                <div class="col-md-10">
                                    <select id="role" data-spry='username'
                                        class="spryValidation form-control  @error('role') is-invalid @enderror"
                                        name="role">
                                        <option disabled>----- Select a role -----</option>
                                        <option {{ $user->role == 0 ? 'selected' : '' }} value=0>User</option>
                                        <option {{ $user->role == 1 ? 'selected' : '' }} value=1>Seller</option>
                                        <option {{ $user->role == 2 ? 'selected' : '' }} value=2>Admin</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-10 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Edit') }}
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

@endsection

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProductsController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\SliderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(
    [
        "prefix" => "admin",
        'as' => 'admin.',
        'middleware' => ['auth', 'role:admin|seller'],
    ],
    function () {
        Route::get('home', [AdminController::class, 'index'])->name("home");

        Route::get('products/show', [AdminProductsController::class, "showAllProducts"])->name("show.products");
        Route::get('users/show', [AdminUsersController::class, "showAllUsers"])->name("show.users");

        Route::resource('products', AdminProductsController::class);
        Route::resource('users', AdminUsersController::class);

        Route::get('edit-slider', [SliderController::class, 'index'])->name("edit-slider");
        Route::post('update-slider', [SliderController::class, 'update'])->name("update.slider");

        Route::get('edit-brands', [BrandController::class, 'index'])->name("edit.brands");
        Route::post('update-brands', [BrandController::class, 'update'])->name("update.brands");

        Route::resource('admin/products', AdminProductsController::class);
    }
);

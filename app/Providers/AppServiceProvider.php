<?php

namespace App\Providers;

use App\Models\Like;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use App\Models\Address;
use App\Models\Brand;
use App\Models\Slider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(["admin.site.slider.index"], function ($view) {
            $products = Product::all();
            $sliders = Slider::all();
            $view->with(['products' => $products, 'sliders' => $sliders]);
        });

        View::composer(["admin.site.brand.index"], function ($view) {
            $brands = Brand::all();
            $allBrands = Product::getAllProductBrands();
            $view->with(['allBrands' => $allBrands, "brands" => $brands]);
        });

        View::composer("user.orders", function ($view) {

            $view->with('addresses', Address::class);
        });


        // User routes
        View::composer(["/", "user.home", "user.checkout", "user.cart"], function ($view) {
            $view->with('products', Product::class);
        });

        View::composer(["/", "user.home"], function ($view) {
            $brands = Brand::all();
            $sliders = Slider::all();

            $view->with(['likes' => Like::class, 'sliders' => $sliders, 'brands' => $brands]);
        });

        View::composer(["user.products.show"], function ($view) {
            $view->with(['user' => User::class, "products" => Product::class]);
        });

        View::composer("*", function ($view) {
            if (Auth::check()) {
                $cart = Cart::where('user_id', Auth::user()->id)->first();
                $view->with('cart', $cart);
            }
        });

        // Paginator::useBootstrap();
    }
}

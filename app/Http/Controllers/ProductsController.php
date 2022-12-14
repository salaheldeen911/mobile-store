<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::inRandomOrder()->paginate(6);
        return view("user.products.index")->with(["products" => $products, "product_details" => new Product()]);
    }

    public function show($id)
    {
        $product = Product::find($id);
        return view("user.products.show")->with("product", $product);
    }
}

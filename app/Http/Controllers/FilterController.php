<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductSearch\ProductsSearch;

class FilterController extends Controller
{
    public function filter(Request $request)
    {
        $products =  ProductsSearch::apply($request);
        return view('user.products.index')->with(['products' => $products, "response" => $request->all()]);
    }

    public function brand($brand)
    {
        $products = Product::where('brand', $brand)->paginate(4);

        return view('user.products.index')->with('products', $products);
    }
}

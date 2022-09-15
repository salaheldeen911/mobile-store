<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FilterController extends Controller
{
    public function filter(Request $request, Product $product)
    {
        $products = $product->newQuery();
        if ($request->has('name')) {
            $products->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->has('category')) {
            $products->whereIn('category', $request->category);
        }
        if ($request->has('price')) {
            foreach ($request->price as $key => $value) {
                $products->whereBetween('price', [$value, $value * 2]);
            }
        }
        if ($request->has('brand')) {
            $products->whereIn('brand', $request->brand);
        }
        if ($request->has('color')) {
            $products->where('color', $request->color);
        }
        if ($request->has('sort') && $request->sort !== null) {
            $products = $products->orderBy('price', $request->sort)->paginate(4);
        } else {
            $products = $products->paginate(4);
        }

        return view('user.products.index')->with(['products' => $products, "response"=>$request->all()]);
    }

    public function brand($brand)
    {
        $products = Product::where('brand', $brand)->paginate(4);

        return view('user.products.index')->with('products', $products);
    }

}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Product;
use Yajra\DataTables\DataTables;


class LikesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $likes = auth()->user()->likes;
        return view('user.wishlist')->with(['likes' => $likes, 'product' => Product::class ]);
    }
    
    public function like(Product $product)
    {
        if (Like::where(['product_id' => $product->id, "user_id" => auth()->user()->id])->exists()) {
            return response()->json(['message' => 'You already liked this product'], 409);
        }
        Like::create([
            "user_id" => auth()->user()->id,
            "product_id" => $product->id
        ]);
        $newLikesNum = $product->likes + 1;
        Product::where('id', $product->id)->update(['likes' => $newLikesNum]);

        return response()->json(['success' => true]);
    }

    public function disLike(Product $product)
    {
        Like::where(['product_id' => $product->id, "user_id" => auth()->user()->id])->delete();
        if ($product->likes !== 0) {
            Product::where('id', $product->id)->update(['likes' => $product->likes - 1]);
        }

        return response()->json(['success' => true]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\CartProduct;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('user.cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (CartProduct::where(['product_id' => $request->product_id, "cart_id" => auth()->user()->cart->id])->exists()) {
            return response()->json(['message' => 'this product is already in your cart'], 409);
        }

        CartProduct::create([
            "product_id" => $request->product_id,
            "cart_id" => auth()->user()->cart->id,
        ]);

        $count = Cart::where('user_id', auth()->user()->id)->first()->products()->count();

        return response()->json(['message' => 'Product aded successfully!', 'cartQuantity' => $count], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        CartProduct::where(['product_id' => $request->id, "cart_id" => auth()->user()->cart->id])->update([
            "count" => $request->count
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CartProduct::where(['product_id' => $id, "cart_id" => auth()->user()->cart->id])->delete();
        $count = Cart::where('user_id', auth()->user()->id)->first()->products()->count();
        return response()->json(['message' => 'Product removed successfully!', 'cartQuantity' => $count], 200);
    }
}

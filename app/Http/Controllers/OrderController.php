<?php

namespace App\Http\Controllers;

use App\Models\CartProduct;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;


class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->user()->id)->get();
        return view("user.orders")->with("orders", $orders);
    }

    public function store()
    {
        $order = Order::create([
            "user_id" => auth()->user()->id,
            "address_id" => auth()->user()->address->id
        ]);

        $catrProducts = CartProduct::where('cart_id', auth()->user()->cart->id);
        $totals = 0;
        $totalItems = 0;

        foreach ($catrProducts->get() as $cartproduct) {
            $product = Product::where('id', $cartproduct->product_id);

            $count = $cartproduct->count;
            $totalPrice = $product->first()->getAttributes()['price'] * $count;

            $totals += $totalPrice;
            $totalItems += $count;

            $product->update([
                "quantity" => $product->first()->quantity - $count,
                "sold" => $product->first()->sold + $count
            ]);

            if ($product->first()->quantity == 0) {
                $product->delete();
            }

            OrderProduct::create([
                "order_id" => $order->id,
                "product_id" => $cartproduct->product_id,
                "count" => $count,
                "total" => $totalPrice
            ]);
        }

        $order->update([
            "total" => $totals,
            "total_items" => $totalItems
        ]);

        $catrProducts->delete();

        return redirect()->route('orders');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show(Request $request, $id = null)
    {
        if($id) $orders = Order::find($id);
        if(!$id) $orders = Order::with('orderProducts', 'seller.info', 'customer', 'customerAddress')->get();

        return response()->json($orders);
    }

    public function create(Request $request)
    {
        $dataOrder = collect($request->all())->forget('products');
        $order = Order::create($dataOrder->toArray());

        collect(($request->products ?? []))->map(function ($product) use ($order) {
            $product = collect($product)->put('order_id', $order->id);
            OrderProduct::create($product->toArray());
        });

        return response()->json(Order::with('orderProducts')->find($order->id));
    }
}

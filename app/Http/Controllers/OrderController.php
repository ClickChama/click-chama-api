<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\CartItem;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show(Request $request, $id = null)
    {
        if ($id) $orders = Order::with('orderProducts', 'seller.info', 'customer', 'customerAddress')->find($id);
        if (!$id) $orders = Order::with('orderProducts', 'seller.info', 'customer', 'customerAddress')->get();
        return response()->json($orders);
    }

    public function getCustomerOrderId($id)
    {
        $orders = Order::where('customer_id', $id)->with('orderProducts', 'seller.info', 'customer', 'customerAddress')->get();
        return response()->json(
            $orders,
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );
    }

    public function getOrderById($id)
    {
        $orders = Order::where('seller_id', $id)->with('orderProducts', 'seller.info', 'customer', 'customerAddress')->get();
        $ordersCount = Order::where('seller_id', $id)->where('status', 0)->with('orderProducts', 'seller.info', 'customer', 'customerAddress')->count();
        $ordersCount2 = Order::where('seller_id', $id)->where('status', 1)->orWhere('status', 2)->with('orderProducts', 'seller.info', 'customer', 'customerAddress')->count();
        $ordersCount3 = Order::where('seller_id', $id)->where('status', 3)->with('orderProducts', 'seller.info', 'customer', 'customerAddress')->count();
        return response()->json([$orders, $ordersCount, $ordersCount2, $ordersCount3]);
    }

    public function editStatus($id)
    {
        $orders = Order::with('orderProducts', 'seller.info', 'customer', 'customerAddress')->find($id);
        return response()->json($orders);
    }

    public function editStatusStore(Request $request)
    {
        $dataProduct = collect($request->all());
        $order = Order::find($request->id)->update($dataProduct->toArray());

        return response()->json($order);
    }

    public function create(Request $request)
    {
        $dataOrder = collect($request->all())->forget('products');
        $order = Order::create($dataOrder->toArray());

        collect(($request->products ?? []))->map(function ($product) use ($order) {
            $product = collect($product)->put('order_id', $order->id);
            OrderProduct::create($product->toArray());
        });

        $data = $request->all();
        $cart = CartItem::where('customer_id', $data['customer_id']);
        $cart->delete();

        \Log::info($data);
        return response()->json(Order::with('orderProducts')->find($order->id));
    }
}

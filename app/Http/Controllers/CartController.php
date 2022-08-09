<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartAdd(Request $request)
    {

        $cartItens = $request->all();
        \Log::info($cartItens);
        foreach ($cartItens as $key => $iten) {
            $cart = CartItem::create([
                'customer_id' => $iten['customer_id'],
                'seller_id' => $iten['seller_id'],
                'brand' => $iten['brand'],
                'type' => $iten['type'],
                'price' => $iten['price'],
                'product_type' => $iten['product_type'],
                'quantity' => $iten['quantity'],
            ]);
        }
        \Log::info($cart);
        return response()->json('success', 200);
    }

    public function getCart(Request $request)
    {
        $data = $request->all();
        $cart = CartItem::where('customer_id', $data['id'])->get();
        return response()->json($cart);
    }
    public function cartRemove(Request $request)
    {
        $data = $request->all();
        $cart = CartItem::where('customer_id', $data['id']);
        $cart->delete();
    }
}

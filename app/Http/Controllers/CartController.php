<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartAdd(Request $request)
    {

        $cartItens = collect($request->all());
        $cart = CartItem::create($cartItens->toArray());
        return response()->json($cart);
    }

    public function getCart(Request $request)
    {
        $data = $request->all();
        $cart = CartItem::where('customer_id', $data['id'])->get();

        return response()->json($cart);
        \Log::info($cart);
    }
    public function cartRemove(Request $request)
    {
        $data = $request->all();
        $cart = CartItem::where('customer_id', $data['id']);
        $cart->delete();
    }
}

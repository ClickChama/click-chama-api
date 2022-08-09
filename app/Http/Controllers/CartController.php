<?php

namespace App\Http\Controllers;

use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartAdd(Request $request)
    {

        $cart = $request->all();

        // dd($cart);

        \Cart::add(array(
            'id' => $cart['id'],
            'name' => $cart['name'],
            'price' => $cart['value'],
            'quantity' => 1,
            'attributes' => array(
                'brand'    => $cart['brand'],
                'seller_id' => $cart['seller_id'],
            ),

        ));
        return response()->json(\Cart::getContent());
    }

    public function cartRemove($id)
    {
        \Cart::remove($id);
        return response()->json(\Cart::getContent());
    }

    public function cartClear()
    {
        \Cart::clear();

        return response()->json('success');
    }

    public function cartGet()
    {
        $cartItens = \Cart::getContent();
        return response()->json($cartItens);
    }

    public function cartUpdate(Request $request, $id)
    {

        \Cart::update($id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->value,
            ),
          ));

          return response()->json(\Cart::getContent());
    }
}

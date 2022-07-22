<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Request $request, $id = null)
    {
        if($id) $products = Product::find($id);
        if(!$id) $products = Product::paginate($per_page ?? 20);

        return response()->json($products);
    }

    public function create(Request $request)
    {
        $dataProduct = collect($request->all())->put('seller_id', getSeller()->id);
        $product = Product::create($dataProduct->toArray());

        return response()->json($product);
    }

    public function update(Request $request)
    {
        $dataProduct = collect($request->all())->forget(['seller_id', 'id']);
        $product = Product::find($request->id)->update($dataProduct->toArray());

        return response()->json($product);
    }

    public function delete(Request $request)
    {
        $product = Product::whereIn('id', ($request->products_id ?? []))->delete();

        return response()->json('Apagado!');
    }

    public function getSellerProducts(Request $request)
    {
        $seller_products = Seller::with('products', 'info')->get()->makeHidden(['email', 'created_at', 'updated_at', 'email_verified_at', 'phone_verified_at']);

        return response()->json($seller_products);
    }
}

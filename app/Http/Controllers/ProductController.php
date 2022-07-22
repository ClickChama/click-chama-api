<?php

namespace App\Http\Controllers;

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
        # code...
    }

    public function delete(Request $request)
    {
        # code...
    }
}

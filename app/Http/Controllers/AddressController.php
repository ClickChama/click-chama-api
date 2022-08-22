<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        $dataProduct = collect($request->all())->put('customer_id', getCustomer()->id);
        $address = Address::create($dataProduct->toArray());

        return response()->json($address);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $endereco = [
            'customer_id' => 'sem endereco',
            'address' => 'sem endereco',
            'number' => 'sem endereco',
            'complement' => 'sem endereco',
            'district' => 'sem endereco',
            'city' => 'sem endereco',
            'state' => 'sem endereco',
            'zip_code' => 'sem endereco',
            'created_at' => 'sem endereco',
            'updated_at' => 'sem endereco',
        ];

        $data = $request->all();
        $address = Address::where('customer_id', $data['id'])->first();
        if($address){
            return response()->json($address);
        }else{
            return response()->json($endereco);
        }

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

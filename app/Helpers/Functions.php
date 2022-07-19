<?php

use App\Models\Customer;
use App\Models\GeneralTable;
use Illuminate\Support\Facades\Crypt;

if(!function_exists('getCustomer')){
    function getCustomer(){
        if(\Str::contains(\Request::header()['authorization'][0], 'Bearer')){
            $authorization = explode(' ', \Request::header()['authorization'][0])[1];
            $authorization = json_decode(Crypt::decryptString($authorization), true);

            $customer = Customer::with('addresses')->where('email', ($authorization[0]??null))->where('login_token', ($authorization[1]??null))->where('expires_in_login_token', '>=', date('Y-m-d H:i:s'))->first();
        }

        return $customer ?? null;
    }
}

if(!function_exists('sendSMS')){
    function sendSMS($customer){
        GeneralTable::where('table', 'TabelaSMS')->where('collumn', 'customer_id')->where('value', $customer->id)->delete();
        GeneralTable::create([
            'table' => 'TabelaSMS',
            'collumn' => 'customer_id',
            'value' => $customer->id,
            'sub_value_text' => \Str::padLeft(rand(0,9999), 4, '0'),
        ]);
    }
}
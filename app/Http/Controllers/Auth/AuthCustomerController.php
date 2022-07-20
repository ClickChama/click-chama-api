<?php

namespace App\Http\Controllers\Auth;

use App\Models\Address;
use App\Models\Customer;
use Illuminate\Support\Str;
use App\Models\GeneralTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class AuthCustomerController extends Controller
{
    public function login(Request $request)
    {
        \Log::info($request->header());
        \Log::info($request->all());
        $update_token['login_token'] = Str::random(100);
        $update_token['expires_in_login_token'] = date('Y-m-d H:i:s', strtotime('+1 Years'));

        if(Str::contains($request->header()['authorization'][0], 'Basic')){
            $authorization = explode(' ', $request->header()['authorization'][0])[1];
            $authorization = explode(':', base64_decode($authorization));

            if(Auth::guard('customer')->validate(['email' => $authorization[0], 'password' => $authorization[1]])){
                Customer::where('email', $authorization[0])->update($update_token);

                return response()->json([
                    'access_token' => Crypt::encryptString(collect([$authorization[0], $update_token['login_token'], $update_token['expires_in_login_token']])->toJson()),
                    'type' => 'Bearer',
                    'expires_in' => $update_token['expires_in_login_token']
                ]);
            }else{
                return response()->json('Email ou Senha incorretos!', 422);
            }
        }
    }

    public function register(Request $request)
    {
        if(isset($request->name) && !empty($request->name)) $customer_create['name'] = Str::title($request->name);
        $customer_create['email'] = Str::of($request->email)->lower()->trim();
        $customer_create['password'] = Hash::make($request->password);
        $customer_create['phone'] = $request->phone;
        $customer_create['login_token'] = Str::random(100);
        $customer_create['expires_in_login_token'] = date('Y-m-d H:i:s', strtotime('+1 Years'));

        $customer = Customer::create($customer_create);

        sendSMS($customer);

        return response()->json([
            'access_token' => Crypt::encryptString(collect([$customer->email, $customer->login_token, $customer->expires_in_login_token])->toJson()),
            'type' => 'Bearer',
            'expires_in' => $customer->expires_in_login_token
        ]);
    }

    public function update(Request $request)
    {
        $customer_update['name'] = Str::title($request->name);
        if(isset($request->password) || !empty($request->password)) $customer_update['password'] = Hash::make($request->password);
        $customer_update['phone'] = $request->phone;

        Customer::find(getCustomer()->id)->update($customer_update);

        foreach(($request->addresses ?? []) as $address){
            $dataAddress = collect($address ?? []);
            if(isset($dataAddress['id']) || !empty($dataAddress['id'])){
                Address::find($dataAddress['id'])->update($dataAddress->forget(['id'])->toArray());
            }else{
                Address::create($dataAddress->put('customer_id', getCustomer()->id)->toArray());
            }
        }

        return response()->json(getCustomer());
    }

    public function infoCustomer(Request $request)
    {
        return response()->json(getCustomer());
    }

    public function deleteAddress(Request $request)
    {
        Address::where('customer_id', getCustomer()->id)->whereIn('id',($request->addresses_id ?? []))->delete();
        return response()->json('success!');
    }

    public function resendSMS(Request $request)
    {
        sendSMS(getCustomer());

        return response()->json('Codigo Reenviado!');
    }

    public function receiverSMS(Request $request)
    {
        $customer = getCustomer();
        $code_verifi = GeneralTable::where('table', 'TabelaSMS')->where('collumn', 'customer_id')->where('value', $customer->id)->where('sub_value_text', (string)$request->code)->get();
        if($code_verifi->count() > 0){
            Customer::find($customer->id)->update(['phone_verified_at' => date('Y-m-d H:i:s')]);
            GeneralTable::where('table', 'TabelaSMS')->where('collumn', 'customer_id')->where('value', $customer->id)->where('sub_value_text', (string)$request->code)->delete();
            return response()->json('Validado');
        }
        return response()->json('Codigo Invalido!');
    }

    public function sendTokenResetPassword(Request $request)
    {
        if(isset($request->email_recovery) && !empty($request->email_recovery)){
            if(Customer::where('email', $request->email_recovery)->get()->count() > 0){
                GeneralTable::where('table', 'TokenResetPassword')->where('collumn', 'email_recovery')->where('value', $request->email_recovery)->delete();
                $token = Crypt::encryptString($request->email_recovery.':'.date('Y-m-d H:i:s'));
                GeneralTable::create([
                    'table' => 'TokenResetPassword',
                    'collumn' => 'email_recovery',
                    'value' => $request->email_recovery,
                    'sub_value_text' => $token,
                ]);

                return response()->json($token);
            }
        }

        return response()->json('Dados invalidos');
    }

    public function resetPassword(Request $request)
    {
        if(isset($request->email) && !empty($request->email)){
            if(GeneralTable::where('table', 'TokenResetPassword')->where('collumn', 'email_recovery')->where('value', $request->email)->where('sub_value_text', $request->token)->get()->count() > 0){
                GeneralTable::where('table', 'TokenResetPassword')->where('collumn', 'email_recovery')->where('value', $request->email)->where('sub_value_text', $request->token)->delete();

                Customer::where('email',$request->email)->update(['password'=> Hash::make($request->password)]);

                return response()->json('Senha Alterada!');
            }
        }
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Models\Seller;
use App\Models\SellerInfo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class AuthSellerController extends Controller
{
    public function login(Request $request)
    {
        $update_token['login_token'] = Str::random(100);
        $update_token['expires_in_login_token'] = date('Y-m-d H:i:s', strtotime('+1 Years'));

        if(Str::contains($request->header()['authorization'][0], 'Basic')){
            $authorization = explode(' ', $request->header()['authorization'][0])[1];
            $authorization = explode(':', base64_decode($authorization));

            if(Auth::guard('seller')->validate(['email' => $authorization[0], 'password' => $authorization[1]])){
                Seller::where('email', $authorization[0])->update($update_token);

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
        if(isset($request->name) && !empty($request->name)) $seller_create['name'] = Str::title($request->name);
        $seller_create['email'] = Str::of($request->email)->lower()->trim();
        $seller_create['password'] = Hash::make($request->password);
        $seller_create['phone'] = $request->phone ?? Str::random(10);
        $seller_create['login_token'] = Str::random(100);
        $seller_create['expires_in_login_token'] = date('Y-m-d H:i:s', strtotime('+1 Years'));

        $seller = Seller::create($seller_create);

        return response()->json([
            'access_token' => Crypt::encryptString(collect([$seller->email, $seller->login_token, $seller->expires_in_login_token])->toJson()),
            'type' => 'Bearer',
            'expires_in' => $seller->expires_in_login_token
        ]);
    }

    public function update(Request $request)
    {
        $seller_update['name'] = Str::title($request->name);
        if(isset($request->password) || !empty($request->password)) $seller_update['password'] = Hash::make($request->password);
        $seller_update['phone'] = $request->phone;

        Seller::find(getSeller()->id)->update($seller_update);

        $dataInfo['seller_id'] = getSeller()->id;
        $dataInfo['app_name'] = $request->app_name;
        $dataInfo['app_phone'] = $request->app_phone;
        $dataInfo['cnpj'] = $request->cnpj;
        $dataInfo['corporate_name'] = $request->corporate_name;
        $dataInfo['address'] = $request->address;
        $dataInfo['number'] = $request->number;
        $dataInfo['complement'] = $request->complement;
        $dataInfo['district'] = $request->district;
        $dataInfo['city'] = $request->city;
        $dataInfo['state'] = $request->state;
        $dataInfo['zip_code'] = $request->zip_code;
        $dataInfo['delivery_radius'] = $request->delivery_radius;
        $dataInfo['delivery_time'] = $request->delivery_time;
        $dataInfo['lat'] = $request->lat;
        $dataInfo['lng'] = $request->lng;
        if(SellerInfo::where('seller_id', getSeller()->id)->get()->count() > 0){
            SellerInfo::where('seller_id', getSeller()->id)->update($dataInfo);
        }else{
            SellerInfo::create($dataInfo);
        }

        return response()->json(getSeller());
    }

    public function infoSeller(Request $request)
    {
        return response()->json(getSeller());
    }
}

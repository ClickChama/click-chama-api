<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AuthCustomerToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(\Str::contains($request->header()['authorization'][0], 'Bearer')){
            $authorization = explode(' ', $request->header()['authorization'][0])[1];
            $authorization = json_decode(Crypt::decryptString($authorization), true);

            $customer = Customer::where('email', ($authorization[0]??null))->where('login_token', ($authorization[1]??null))->where('expires_in_login_token', '>=', date('Y-m-d H:i:s'))->first();

            if($customer) return $next($request);
        }

        return response()->json('Token Invalido!',422);
    }
}

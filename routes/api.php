<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthCustomerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

################ROTAS DE LOGIN E REGISTRO################
########ROTAS DO CLIENTE########
Route::post('auth/customer/login', [AuthCustomerController::class, 'login'])->name('auth.customer.login');
Route::post('auth/customer/register', [AuthCustomerController::class, 'register'])->name('auth.customer.register');
Route::middleware(['auth.customer.token'])->put('auth/customer/update', [AuthCustomerController::class, 'update'])->name('auth.customer.update');
Route::middleware(['auth.customer.token'])->get('auth/customer/info', [AuthCustomerController::class, 'infoCustomer'])->name('auth.customer.info');
Route::middleware(['auth.customer.token'])->delete('auth/customer/delete-address', [AuthCustomerController::class, 'deleteAddress'])->name('auth.customer.deleteAddress');
Route::middleware(['auth.customer.token'])->post('auth/customer/resend-sms', [AuthCustomerController::class, 'resendSMS'])->name('auth.customer.resendSMS');
Route::middleware(['auth.customer.token'])->post('auth/customer/receiver-sms', [AuthCustomerController::class, 'receiverSMS'])->name('auth.customer.receiverSMS');
Route::post('auth/customer/send-token-reset-password', [AuthCustomerController::class, 'sendTokenResetPassword'])->name('auth.customer.sendTokenResetPassword');
Route::post('auth/customer/token-reset-password', [AuthCustomerController::class, 'resetPassword'])->name('auth.customer.resetPassword');
################################
#########################################################
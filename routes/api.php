<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\AuthSellerController;
use App\Http\Controllers\Auth\AuthCustomerController;
use App\Http\Controllers\CartController;

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

Route::middleware(['auth.seller.token'])->prefix('seller')->group(function(){
    Route::get('product/{id?}', [ProductController::class, 'show'])->name('product');
    Route::post('product', [ProductController::class, 'create'])->name('product');
    Route::put('product', [ProductController::class, 'update'])->name('product');
    Route::delete('product', [ProductController::class, 'delete'])->name('product');

    Route::get('order/{id?}', [OrderController::class, 'show'])->name('order');
    Route::post('order', [OrderController::class, 'create'])->name('order');
});

Route::middleware(['auth.customer.token'])->prefix('customer')->group(function(){
    Route::get('order/{id?}', [OrderController::class, 'show'])->name('customer.order');
    Route::post('order', [OrderController::class, 'create'])->name('customer.order');
});

Route::get('get-seller-products', [ProductController::class, 'getSellerProducts'])->name('getSellerProducts');
Route::get('get-all-products/{id}', [ProductController::class, 'getProductsBySeller'])->name('getProductsBySeller');

################ROTAS DE LOGIN E REGISTRO################
########ROTAS DO VENDEDOR########
Route::post('auth/seller/login', [AuthSellerController::class, 'login'])->name('auth.seller.login');
Route::post('auth/seller/register', [AuthSellerController::class, 'register'])->name('auth.seller.register');
Route::middleware(['auth.seller.token'])->put('auth/seller/update', [AuthSellerController::class, 'update'])->name('auth.seller.update');
Route::middleware(['auth.seller.token'])->get('auth/seller/info', [AuthSellerController::class, 'infoSeller'])->name('auth.seller.info');
################################
########ROTAS DO CLIENTE########
Route::post('auth/customer/login', [AuthCustomerController::class, 'login'])->name('auth.customer.login');
Route::post('auth/customer/register', [AuthCustomerController::class, 'register'])->name('auth.customer.register');
Route::middleware(['auth.customer.token'])->put('auth/customer/update', [AuthCustomerController::class, 'update'])->name('auth.customer.update');
Route::middleware(['auth.customer.token'])->get('auth/customer/info', [AuthCustomerController::class, 'infoCustomer'])->name('auth.customer.info');
Route::middleware(['auth.customer.token'])->delete('auth/customer/delete-address', [AuthCustomerController::class, 'deleteAddress'])->name('auth.customer.deleteAddress');
Route::middleware(['auth.customer.token'])->post('auth/customer/resend-sms', [AuthCustomerController::class, 'resendSMS'])->name('auth.customer.resendSMS');
Route::middleware(['auth.customer.token'])->post('auth/customer/receiver-sms', [AuthCustomerController::class, 'receiverSMS'])->name('auth.customer.receiverSMS');

Route::post('adress/store', [AddressController::class, 'store'])->middleware(['auth.customer.token'])->name('adress.store');
Route::post('adress/get', [AddressController::class, 'show'])->name('adress.get');

Route::post('auth/customer/send-token-reset-password', [AuthCustomerController::class, 'sendTokenResetPassword'])->name('auth.customer.sendTokenResetPassword');
Route::post('auth/customer/token-reset-password', [AuthCustomerController::class, 'resetPassword'])->name('auth.customer.resetPassword');

Route::post('cart-add', [CartController::class, 'cartAdd']);
Route::post('cart-get', [CartController::class, 'getCart']);
Route::post('cart-clear', [CartController::class, 'cartRemove']);

################################
#########################################################

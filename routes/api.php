<?php

use App\Http\Controllers\Api\AppUser\ApiAppUserHomeController;
use App\Http\Controllers\Api\AppUser\ApiRestaurantController;
use App\Http\Controllers\Api\AppUser\ApiUserController;
use App\Http\Controllers\Paypal\PaypalPaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix'=>'paypal'], function(){
    Route::post('/order/createCeo',[PaypalPaymentController::class,'createCeo']);
    Route::post('/order/captureCeo/',[PaypalPaymentController::class,'captureCeo']);
    Route::post('/order/createUser',[PaypalPaymentController::class,'createUser']);
    Route::post('/order/captureUser/',[PaypalPaymentController::class,'captureUser']);
});

// Routsadasde::middleware('auth:api')->group(function () {
Route::prefix('app-user-sell')->group(function () {
    Route::prefix('user/')->group(function () {
        Route::post('register', [ApiUserController::class, 'store']);
        Route::post('register-active/{id}', [ApiUserController::class, 'verifyRegister']);
        Route::post('login', [ApiUserController::class, 'login']);
        Route::post('password/reset', [ApiUserController::class, 'forgotPassword']);
        Route::post('password/reset/verify/{id}', [ApiUserController::class, 'verifyForgotPassword']);
        Route::post('password/reset/create/{id}', [ApiUserController::class, 'createForgotPassword']);
    
        Route::middleware(['auth:api'])->group(function () {
            Route::post('logout', [ApiUserController::class, 'logout']);
            Route::post('change-password', [ApiUserController::class, 'changePassword']);
            Route::get('show', [ApiUserController::class, 'show']);
            Route::post('update', [ApiUserController::class, 'update']);
        });
    });

    Route::middleware(['auth:api'])->group(function () {
        Route::prefix('restaurant/')->group(function () {
            Route::get('show/{id}', [ApiRestaurantController::class, 'show']);
        });
        Route::prefix('home/')->group(function () {
            Route::get('/', [ApiAppUserHomeController::class, 'index']);
        });
    });
});

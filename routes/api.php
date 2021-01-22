<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CybersourceController;

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

Route::group(['middleware' => ['throttle:60,1']], function () {
    // Authentication
    Route::post('login', [AuthController::class, 'postLogin']);
    Route::post('signup', [AuthController::class, 'postSignup']);
    Route::post('forgot-password', [AuthController::class, 'postForgotPassword']);

    Route::middleware('auth:api')->group( function () {
        // Authentication
        Route::get('user', [AuthController::class, 'getUser']);
        Route::get('logout', [AuthController::class, 'getLogout']);

        Route::resource('products', ProductController::class);
    });

    // Cybersource
    Route::group(['prefix' => 'cybsersources'], function () {
        Route::post('checkout', [CybersourceController::class, 'postCheckout']);
    });

    // Fallback when URL is not existed.
    Route::fallback(function(){
        return response()->json([
            'success' => false,
            'message' => 'Page Not Found. If error persists, contact q3construction1@gmail.com',
        ], 404);
    });
});

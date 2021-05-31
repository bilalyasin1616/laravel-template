<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StripeHelperController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// User Routes
Route::post('/signup',[UserController::class, 'Signup']);
Route::post('/signin',[UserController::class, 'Signin']);

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('/getAll',[UserController::class, 'GetAll']);
    Route::get('/get',[UserController::class,'Get']);
});

// Stripe Routes
Route::post('/stripe/subscription',[StripeHelperController::class, 'Subscription']);
Route::post('/stripe/onetimepayment',[StripeHelperController::class, 'OneTimePayment']);
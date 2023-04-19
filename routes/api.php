<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/students","StudentController@indexApi");
Route::post("/students","StudentController@storeApi");
Route::post("/ussd-requests", "UssdController@ussdRequest");

Route::post("/opay/payment-response", "StudentController@opayPaymentResponse");

Route::get("/history", "ApiController@history");
Route::post("/login", "ApiController@login");
Route::post("/validate-card", "ApiController@validateCard");
Route::get("/validations-report", "ApiController@validationsReport");


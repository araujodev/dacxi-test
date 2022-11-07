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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('price/health', [\App\Http\Controllers\PriceController::class, 'testPriceClient']);
Route::get('price/{cryto}/latest', [\App\Http\Controllers\PriceController::class, 'latestPrice']);
Route::get('price/{crypto}/from/{datetime}', [\App\Http\Controllers\PriceController::class, 'priceFromDatetime']);

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

// Route::resource('agent/product', Api\Agent\Ecommerce\AgentProductController::class);

// Route::prefix('agent')->namespace('\App\Http\Controllers\Api\Agent')->group(function () {
//     Route::prefix('ecommerce')->group(function () {
//         Route::resource('product', Ecommerce\AgentProductController::class);
//         Route::post('product/feature-image/upload',  'Ecommerce\AgentProductController@leadFeatureImageChange');
//     });
// });
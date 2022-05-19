<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\ShopController;

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

Route::group(['prefix' => 'product', 'as'=>'product.'], function(){
    Route::get('{id}', [ProductController::class, 'index'])->where(['id' => '[0-9]+']);
    Route::post('create', [ProductController::class, 'create'])->middleware(['custom_auth']);
    Route::put('{id}/update', [ProductController::class, 'update'])->middleware(['custom_auth'])->where(['id' => '[0-9]+']);
});
Route::get('/products', [ProductController::class, 'getAll']);

Route::group(['prefix' => 'shop', 'as'=>'shop.'], function(){
    Route::get('{id}/get_product', [ShopController::class, 'getProduct'])->where(['id' => '[0-9]+']);
});


Route::post('login', [\App\Http\Controllers\UserController::class, 'login']);

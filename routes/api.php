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

Route::group(['prefix' => 'v1'], function(){



    Route::resource('/categories', App\Http\Controllers\Api\CategoryController::class);
    Route::resource('/brands', App\Http\Controllers\Api\BrandController::class);
    Route::resource('/banners', App\Http\Controllers\Api\BannerController::class);
    Route::resource('/posts', App\Http\Controllers\Api\PostController::class);
    Route::resource('/products', App\Http\Controllers\Api\ProductController::class);

    Route::get('categorypost/{id}', [App\Http\Controllers\Api\PostController::class, 'categorypost'])->name('categorypost');

	Route::get('/{slug}', [App\Http\Controllers\Api\SlugController::class, 'index'])->name('/');




});
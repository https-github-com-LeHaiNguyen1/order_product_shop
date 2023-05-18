<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ProductsController;

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
// Route::controller(AuthController::class)->group(function () {
//     Route::post('auth', 'register')->name('register');
// });

Route::group(['prefix' => 'auth'], function () {
        Route::post('register', 'AuthController@register');
        Route::post('login', 'AuthController@login');
        Route::group(['middleware' => 'auth:api'], function () {
            Route::get('logout', 'AuthController@logout');
        });
    });

Route::controller(ProductsController::class)->group(function () {
    Route::post('products', 'store')->name('store');
    Route::get('products', 'show')->name('show');
    Route::put('products/{id}', 'update')->name('update');
    Route::delete('products/{id}', 'destroy')->name('destroy');
});
// Route::resource('products','ProductsController');

<?php

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// gọi hàm Auth::logout() để đăng xuất người dùng và chuyển hướng trang về trang đăng nhập
Auth::routes();
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/', [App\Http\Controllers\Auth\LoginController::class, 'postLogin'])->name('postLogin');
Route::get('password/reset/{token}', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset')->name('password.update');
Route::get('password/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/admin/menus', function () {
    return view('Admin.index');
})->name('page');
Route::get('/page', function () {
    return view('MyPage.index');
})->name('page');

// Route::get('/menus', function () {
//     return App\Models\Menu::orderBy('order')->get();
// });
use App\Models\Menu;

Route::get('/menus', function () {
    $menus = Menu::select('id', 'name', 'parent_id')->get();
    return response()->json($menus);
});
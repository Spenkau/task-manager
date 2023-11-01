<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// TODO: для роутов админки создать отдельный файл
Route::get('/profile', function () {
    return view('profile');
})->middleware('auth');

Route::get('api/user/register', [RegisterController::class, 'create']);

Route::middleware('guest')->namespace('\App\Http\Controllers')->group(function () {
    Route::get('/login', function () {
        return view('login');
    });

    Route::post('/login', 'AuthController@postSignin');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

Route::get('{any?}', fn() => view('app'))->where('any', '.*');

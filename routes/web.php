<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Route::get('/', [MainPageController::class, 'index']);
//Route::post('/', ButtonClickedController::class);
//Route::get('/', ButtonClickedController::class);
//
//Route::get('/api/main', function(){
//
//    $message = 'HELLO WORRDL';
//
//    broadcast(new \App\Events\ButtonClicked($message));
////    return view('filtered_tasks', ['message' => $message]);
//});

/**************************** AUTH *************************/
// TODO: для роутов админки создать отдельный файл
Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('login');
});

Route::middleware('guest')->namespace('\App\Http\Controllers')->group(function () {
    Route::get('/login', function () {
        return view('login');
    });

    Route::post('/login', 'AuthController@postSignin');
});
/**************************** END AUTH *************************/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/**************************** ADMIN *************************/
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

/**************************** END ADMIN *************************/

Route::get('{any?}', fn() => view('app'))->where('any', '.*');

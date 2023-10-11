<?php

use App\Http\Controllers\Task\IndexController;
use App\Http\Controllers\Task\ShowController;
use App\Http\Controllers\Task\StoreController;
use App\Http\Controllers\Task\UpdateController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace' => 'App\Http\Controllers\Task'], function () {
    Route::get('/tasks', IndexController::class)->name('tasks.index');
    Route::get('/tasks/{task}', ShowController::class)->name('tasks.show');
    Route::patch('/tasks/{task}', UpdateController::class)->name('tasks.update');
    Route::post('/tasks/{task}', StoreController::class)->name('tasks.store');
});
// TODO: для роутов админки создать отдельный файл
Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('login');
});

Route::middleware('guest')->namespace('\App\Http\Controllers')->group(function() {
    Route::get('/login', function () {
        return view('login');
    });

    Route::post('/login', 'AuthController@postSignin');
});

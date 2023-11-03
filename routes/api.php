<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('tags', [TagController::class, 'index']);

Route::group(['namespace' => 'Category', 'prefix' => 'categories'], function () {
    Route::get('all', [CategoryController::class, 'index']);

    Route::get('with_children', [CategoryController::class, 'withChildren']);

    Route::post('create', [CategoryController::class, 'store']);
    Route::patch('update', [CategoryController::class, 'update']);
    Route::delete('delete', [CategoryController::class, 'delete']);
});
Route::group(['namespace' => 'Task', 'prefix' => 'tasks'], function () {
    Route::get('', [TaskController::class, 'index']);

    Route::get('category/{slug}', [TaskController::class, 'showByCategory']);
    Route::get('tag/{slug}', [TaskController::class, 'showByTag']);
    Route::get('{task}', [TaskController::class, 'show']);

    Route::post('store', [TaskController::class, 'store']);
    Route::patch('{task}', [TaskController::class, 'update']);
    Route::delete('{task}', [TaskController::class, 'softDelete']);

    Route::get('filter', [TaskController::class, 'filterTasks']);
});

Route::group(['namespace' => 'User', 'prefix' => 'users'], function () {
    Route::get('', [UserController::class, 'index']);
//    Route::get('{username}', [UserController::class, 'show']);
    Route::post('create', [UserController::class, 'create']);
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

    Route::group(['middleware' => 'auth:api'], function () {
    });

});

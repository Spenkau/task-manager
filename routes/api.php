<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('store', [UserController::class, 'store']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

    Route::group(['middleware' => 'jwt.auth'], function () {

        Route::group(['namespace' => 'User', 'prefix' => 'users'], function () {
            Route::get('{username}', [UserController::class, 'show']);
        });

        Route::group(['namespace' => 'Task', 'prefix' => 'task'], function () {
            Route::get('{task}', [TaskController::class, 'show']);

            Route::get('category/{slug}', [TaskController::class, 'showByCategory']);

            Route::post('store', [TaskController::class, 'store']);
            Route::patch('update', [TaskController::class, 'update']);
            Route::delete('delete/{task}', [TaskController::class, 'delete']);
            Route::post('status_update', [TaskController::class, 'manageStatus']);
        });

        Route::get('nested_tasks', [TaskController::class, 'nested']);
        Route::get('flat_tasks', [TaskController::class, 'flat']); // allowed query params

        Route::group(['namespace' => 'Comment', 'prefix' => 'comment'], function () {
            Route::post('store', [CommentController::class, 'store']);
            Route::patch('update', [CommentController::class, 'update']);
            Route::delete('delete', [CategoryController::class, 'delete']);
        });

            Route::group(['namespace' => 'Category', 'prefix' => 'categories'], function () {
            Route::get('all', [CategoryController::class, 'index']);

            Route::get('with_children', [CategoryController::class, 'withChildren']);

            Route::post('store', [CategoryController::class, 'store']);
            Route::patch('update', [CategoryController::class, 'update']);
            Route::delete('delete/{category}', [CategoryController::class, 'delete']);
        });

        Route::group(['namespace' => 'Tag', 'prefix' => 'tags'], function () {
            Route::get('', [TagController::class, 'index']);

            Route::post('store', [TagController::class, 'store']);
            Route::patch('update', [TagController::class, 'update']);
            Route::delete('delete/{tag}', [TagController::class, 'delete']);
        });

        Route::get('test', function () {
            return Task::find(20);
        });
    });
});

<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('store', [UserController::class, 'store']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
//    Route::post('token', 'AuthController@authenticateWithToken');
    Route::post('me', [AuthController::class, 'me']);

    Route::group(['middleware' => 'jwt.auth'], function () {

        Route::group(['namespace' => 'User', 'prefix' => 'users'], function () {
            Route::get('', [UserController::class, 'index']);
            Route::get('{username}', [UserController::class, 'show']);
        });

        Route::group(['namespace' => 'Task', 'prefix' => 'tasks'], function () {
            Route::get('', [TaskController::class, 'index']);

            Route::get('category/{slug}', [TaskController::class, 'showByCategory']);
            Route::get('tag/{slug}', [TaskController::class, 'showByTag']);
            Route::get('{task}', [TaskController::class, 'show']);

            Route::post('store', [TaskController::class, 'store']);
            Route::patch('update', [TaskController::class, 'update']);
            Route::delete('delete/{task}', [TaskController::class, 'delete']);

            Route::post('status_update', [TaskController::class, 'manageStatus']);

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
            $task = Task::find(20);

            return $task;
        });
    });
});

// TODO таблица task_user - таблица участников задания. Переименовать на members. Узнать нужна ли модель для этого
// TODO чтобы получить все доступные задачи участнику $user->tasks. Чтобы получить всех участников задания
//TODO $task->users;

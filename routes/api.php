<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Task', 'prefix' => 'tasks'], function () {
    Route::get('', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('/store', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('category/{slug}', [TaskController::class, 'showByCategory']);
    Route::get('tag/{slug}', [TaskController::class, 'showByTag']);
    Route::get('{task}', [TaskController::class, 'show'])->name('tasks.show');
    Route::patch('{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('{task}', [TaskController::class, 'softDelete'])->name('tasks.delete');
});

Route::get('tags', [TagController::class, 'index'])->name('tags.index');

Route::group(['namespace' => 'Category', 'prefix' => 'categories'], function () {
    Route::get('all', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('with_children', [CategoryController::class, 'withChildren'])->name('categories.withChildren');
    Route::post('create', [CategoryController::class, 'store'])->name('categories.store');
    Route::patch('update', [CategoryController::class, 'update'])->name('categories.update');
});

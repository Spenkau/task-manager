<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main');
});
/**************************** TASKS *************************/
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::post('/tasks/{task}', [TaskController::class, 'store'])->name('tasks.store');
/**************************** END TASKS *************************/

/**************************** CATEGORIES *************************/
Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/categories/create', [CategoryController::class, 'store'])->name('categories.store');
Route::patch('/categories/update', [CategoryController::class, 'update'])->name('categories.update');
/**************************** END CATEGORIES *************************/



/**************************** ADMIN *************************/
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
/**************************** END ADMIN *************************/

<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main');
});
// TODO сделать на одинаковые пути разные контроллеры
/**************************** TASKS *************************/
Route::prefix('tasks')->group(function () {
    Route::get('', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('{slug}', [TaskController::class, 'showByCategory'])->where('slug', '[a-z]+')->name('tasks.showByCategory');
    Route::get('{task}', [TaskController::class, 'show'])->where('task', '[0-9]+')->name('tasks.show');
    Route::patch('{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('{task}', [TaskController::class, 'softDelete'])->name('tasks.delete');
});

/**************************** END TASKS *************************/

/**************************** CATEGORIES *************************/

Route::get('/', [CategoryController::class, 'index', TaskController::class, 'index'])->name('categories.index');
Route::post('/categories/create', [CategoryController::class, 'store'])->name('categories.store');
Route::patch('/categories/update', [CategoryController::class, 'update'])->name('categories.update');

/**************************** END CATEGORIES *************************/


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


Route::get('/personal-area', function () {
    return view('pages.personalArea');
});

/**************************** ADMIN *************************/
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

/**************************** END ADMIN *************************/


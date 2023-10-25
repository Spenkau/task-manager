<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MainPageController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    Route::get('/', [MainPageController::class, 'index'])->name('main_page.index');

    // TODO задачи: сделать общий репозиторий, изменить подход с контроллером для множественных данных, добавить енумов, перенести
    // ресурсы в репу либо контроллер

    /**************************** TASKS *************************/
    Route::prefix('tasks')->group(function () {
        Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
        Route::post('/', [TaskController::class, 'store'])->name('tasks.store');
        Route::get('/category/{slug}', [TaskController::class, 'showByCategory']);
        Route::get('tag/{slug}', [TaskController::class, 'showByTag']);
        Route::get('{task}', [TaskController::class, 'show'])->name('tasks.show');
        Route::patch('{task}', [TaskController::class, 'update'])->name('tasks.update');
        Route::delete('{task}', [TaskController::class, 'softDelete'])->name('tasks.delete');
    });
    /**************************** END TASKS *************************/

    /**************************** START TAGS *************************/
    Route::get('tags', [TagController::class, 'index'])->name('tags.index');
    /**************************** END TAGS *************************/



    /**************************** CATEGORIES *************************/
    Route::prefix('categories')->group(function () {
    //    Route::get('', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('create', [CategoryController::class, 'store'])->name('categories.store');
        Route::patch('update', [CategoryController::class, 'update'])->name('categories.update');
    });
    /**************************** END CATEGORIES *************************/
});



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

Route::get('{any?}', fn () => view('app'))->where('any','.*');

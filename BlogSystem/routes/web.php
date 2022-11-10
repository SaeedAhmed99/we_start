<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\PagesController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\LogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::group(['as' => 'front.'], function () {
    Route::get('/', [PagesController::class, 'index'])->name('index');
    Route::get('/about', [PagesController::class, 'about'])->name('about');
    Route::get('/post', [PagesController::class, 'post'])->name('post');
    Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/logs', [LogController::class, 'index'])->name('logs');

    Route::group(['prefix' => 'posts', 'as' => 'posts.'], function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/store', [PostController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PostController::class, 'edit'])->name('edit');
        Route::post('/update', [PostController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [PostController::class, 'destroy'])->name('destroy');
        Route::get('/forcedelete/{id}', [PostController::class, 'forcedelete'])->name('forcedelete');
        Route::get('/restore/{id}', [PostController::class, 'restore'])->name('restore');
        Route::get('/trashed', [PostController::class, 'trash'])->name('trash');
    });
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

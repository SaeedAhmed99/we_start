<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\PagesController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\PostController;

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

    Route::group(['prefix' => 'posts', 'as' => 'posts.'], function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/store', [PostController::class, 'store'])->name('store');
    });
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

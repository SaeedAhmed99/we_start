<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\FrontController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\HomeController;


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

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::group(['prefix' => 'home', 'as' => 'home.'], function () {
        Route::get('/', [HomeController::class, 'index'])->name('index');
        Route::get('/create', [HomeController::class, 'create'])->name('create');
        Route::post('/store', [HomeController::class, 'store'])->name('store');
        Route::get('/featch', [HomeController::class, 'featch'])->name('featch');
    });
});

Route::group(['as' => 'front.'], function () {
    Route::get('/', [FrontController::class, 'index'])->name('index');
    Route::get('/home-details/{id}', [FrontController::class, 'homeDetails'])->name('home.details');
    Route::post('/home-details/choose', [FrontController::class, 'chooseHome'])->name('home.choose');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

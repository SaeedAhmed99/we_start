<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CouponsController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\NotifyController;
use Illuminate\Notifications\Notification;

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

Route::group(['as' => 'admin.', 'middleware' => 'auth' ,], function () {
    Route::get('/', [AdminController::class, 'index']);

    Route::group(['prefix' => 'categories', 'as' => 'category.'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::get('/destroy/{id}', [CategoryController::class, 'destroy'])->name('destroy');
        Route::get('/{id}', [CategoryController::class, 'show'])->name('show');
        Route::put('/{id}', [CategoryController::class, 'update'])->name('update');
    });

    Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/edit', [ProductController::class, 'edit'])->name('edit');
        Route::post('/destroy/{id}', [ProductController::class, 'destroy'])->name('destroy');
        Route::post('add-new-image', [ProductController::class, 'add_image'])->name('add.image');
    });

    Route::group(['prefix' => 'coupons', 'as' => 'coupons.'], function () {
        Route::get('/', [CouponsController::class, 'index'])->name('index');
        Route::get('/create', [CouponsController::class, 'create'])->name('create');
        Route::post('/store', [CouponsController::class, 'store'])->name('store');
        Route::get('{id}', [CouponsController::class, 'show'])->name('show');
        Route::post('update', [CouponsController::class, 'update'])->name('update');
        Route::post('/destroy/{id}', [CouponsController::class, 'destroy'])->name('destroy');
    });

    Route::get('settings/', [SettingController::class, 'index'])->name('settings');
    Route::post('settings/', [SettingController::class, 'store'])->name('settings.store');

    Route::get('send-sms', [NotifyController::class, 'send'])->name('send_sms');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

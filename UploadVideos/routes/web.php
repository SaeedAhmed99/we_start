<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;

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

Route::get('/', [VideoController::class, 'index']);
Route::post('/upload', [VideoController::class, 'upload'])->name('video.upload');


Route::controller(VideoController::class)->group(function(){
    Route::get('upload_file', 'index');
    Route::get('upload_file', 'index');
    Route::post('upload_file/upload', 'upload')->name('upload_file.upload');

});

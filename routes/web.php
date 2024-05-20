<?php

use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('task1', [UserController::class, 'index']);


Route::get('uploads/', [UploadController::class, 'index'])->name('uploads.index');
Route::get('uploads/create', [UploadController::class, 'create'])->name('uploads.create');
Route::post('uploads/store', [UploadController::class, 'store'])->name('uploads.store');

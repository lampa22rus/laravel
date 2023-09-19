<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthorBookController;

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



Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::resources([
        'book'  => Admin\AdminBookController::class,
        'genre' => Admin\AdminGenreController::class,
        'user' => Admin\AdminAutorController::class,
    ]);
    Route::get('/', [HomeController::class,'index']);
});
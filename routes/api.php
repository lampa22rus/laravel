<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthApiController;
use App\Http\Controllers\API\AuthorController;
use App\Http\Controllers\API\GenreController;
use App\Http\Controllers\API\BookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('login', [AuthApiController::class, 'login']);
Route::get('books',     [BookController::class,'getBooks']);
Route::get('book/{id}', [BookController::class,'getBook']);
Route::get('genres',    [GenreController::class,'getGenres']);
Route::get('users',     [AuthorController::class,'getUsers']);
Route::get('user/{id}', [AuthorController::class,'getUser']);

Route::middleware('auth:sanctum')->group( function () {
    Route::post('book/{id}',    [BookController::class,'updateBook']); 
    Route::delete('book/{id}',  [BookController::class,'deleteBook']);
    Route::post('user',    [AuthorController::class,'updateUser']);
});

<?php

use App\Http\Controllers\Auth\Login\AuthorController as LoginAuthorController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('books', [BookController::class, 'index']);
Route::get('book/{id}', [BookController::class, 'show']);
Route::post('author', [AuthorController::class, 'store']);
Route::post('author-login', [LoginAuthorController::class, 'login']);
Route::post('book', [BookController::class, 'store'])->middleware('auth:sanctum');
Route::get('author/{id}', [AuthorController::class, 'show']);
Route::get('authors', [AuthorController::class, 'index']);
Route::post('author/{id}', [AuthorController::class, 'update']);
Route::post('book/{id}', [BookController::class, 'update']);

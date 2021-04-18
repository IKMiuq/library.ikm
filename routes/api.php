<?php

use App\Http\Controllers\AuthorApiController;
use App\Http\Controllers\BookApiController;
use App\Http\Controllers\CommentApiController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Авторы
Route::get('/authors', [AuthorApiController::class, 'index']);
Route::get('/authors/page-{number}/{count}', [AuthorApiController::class, 'page']);
Route::post('/authors', [AuthorApiController::class, 'store']);
Route::put('/authors/{author}', [AuthorApiController::class, 'update']);
Route::delete('/authors/{author}', [AuthorApiController::class, 'delete']);

//Книги
Route::get('/books', [BookApiController::class, 'index']);
Route::post('/books', [BookApiController::class, 'store']);
Route::put('/books/{book}', [BookApiController::class, 'update']);
Route::delete('/books/{book}', [BookApiController::class, 'delete']);

//Комментарии
Route::get('/comments', [CommentApiController::class, 'index']);
Route::put('/comments/{comment}', [CommentApiController::class, 'update']);
Route::post('/comments', [CommentApiController::class, 'store']);
Route::delete('/comments/{comment}', [CommentApiController::class, 'delete']);

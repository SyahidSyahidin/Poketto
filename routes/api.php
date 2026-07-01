<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AdminArticleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/popular', [ArticleController::class, 'popular']);
Route::get('/articles/search', [ArticleController::class, 'search']);
Route::get('/articles/{id}', [ArticleController::class, 'show']);

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/articles/{id}/like', [ArticleController::class, 'toggleLike']);

    Route::middleware('role:admin')->prefix('admin')->group(function () {

        Route::post('/articles', [AdminArticleController::class, 'store']);

        Route::put('/articles/{id}', [AdminArticleController::class, 'update']);

        Route::delete('/articles/{id}', [AdminArticleController::class, 'destroy']);

    });

});
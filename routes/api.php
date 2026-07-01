<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AdminArticleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Bisa diakses oleh siapa saja tanpa login)
|--------------------------------------------------------------------------
*/
Route::get('/articles', [ArticleController::class, 'index']);          // Menampilkan semua artikel
Route::get('/articles/popular', [ArticleController::class, 'popular']);  // Menampilkan artikel terpopuler
Route::get('/articles/{id}', [ArticleController::class, 'show']);       // Menampilkan detail 1 artikel

/*
|--------------------------------------------------------------------------
| Protected Routes (Wajib Login Terlebih Dahulu)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {
    
    // Fitur Pembaca & Admin (Asalkan sudah login)
    Route::post('/articles/{id}/like', [ArticleController::class, 'toggleLike']); // Tombol Like/Unlike

    /*
    |--------------------------------------------------------------------------
    | Admin / Creator Only Routes (Hanya untuk User dengan role 'admin')
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::post('/articles', [AdminArticleController::class, 'store']);       // Membuat tulisan baru
        Route::put('/articles/{id}', [AdminArticleController::class, 'update']);   // Mengubah tulisan
        Route::delete('/articles/{id}', [AdminArticleController::class, 'destroy']); // Menghapus tulisan
    });
});
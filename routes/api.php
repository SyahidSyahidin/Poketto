<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// ─── Auth (publik) ──────────────────────────────────────
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login',    [AuthController::class, 'login']);
});

// ─── Route yang butuh login ─────────────────────────────
Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::post('/auth/logout',  [AuthController::class, 'logout']);
    Route::get('/auth/profile',  [AuthController::class, 'profile']);

    // Products
    Route::prefix('products')->group(function () {
        Route::get('/',        [ProductController::class, 'index']);
        Route::post('/',       [ProductController::class, 'store']);
        Route::get('/{id}',    [ProductController::class, 'show']);
        Route::put('/{id}',    [ProductController::class, 'update']);
        Route::delete('/{id}', [ProductController::class, 'destroy']);
    });
});
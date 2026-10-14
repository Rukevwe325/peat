<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ShopsController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Admin\AuthController;

// API version prefix (v1)
Route::prefix('v1')->group(function () {
    
    // Shop routes
    Route::prefix('shops')->group(function () {
        Route::get('/nearby', [ShopsController::class, 'nearby']);
        Route::get('/', [ShopsController::class, 'index']);
        Route::get('/{id}', [ShopsController::class, 'show']);
    });

    Route::post('/book-appointment/{admin}', [BookController::class, 'store']);

    // ✅ Admin auth routes — moved inside v1
    Route::prefix('admin')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login',    [AuthController::class, 'login']);

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('/logout', [AuthController::class, 'logout']);
        });
    });
});

// Health check
Route::get('/health', function () {
    return response()->json([
        'success' => true,
        'message' => 'API is running',
        'timestamp' => now(),
    ]);
});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\OrderApiController;

Route::post('/login', [AuthController::class, 'apiLogin']);

Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'apiLogout']);

    // Products
    Route::get('/products', [ProductApiController::class, 'index']);
    Route::get('/products/{product}', [ProductApiController::class, 'show']);
    Route::post('/products', [ProductApiController::class, 'store']);
    Route::put('/products/{product}', [ProductApiController::class, 'update']);
    Route::delete('/products/{product}', [ProductApiController::class, 'destroy']);

    // Categories
    Route::get('/categories', [CategoryApiController::class, 'index']);
    Route::get('/categories/{category}', [CategoryApiController::class, 'show']);
    Route::post('/categories', [CategoryApiController::class, 'store']);
    Route::put('/categories/{category}', [CategoryApiController::class, 'update']);
    Route::delete('/categories/{category}', [CategoryApiController::class, 'destroy']);

    // Orders
    Route::get('/orders', [OrderApiController::class, 'index']);
    Route::get('/orders/{order}', [OrderApiController::class, 'show']);
    Route::post('/orders', [OrderApiController::class, 'store']);
    Route::put('/orders/{order}', [OrderApiController::class, 'update']);
    Route::delete('/orders/{order}', [OrderApiController::class, 'destroy']);
});
<?php

use App\Http\Controllers\Api\V1\ChatMessageController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    // User routes
    Route::get('/user', [UserController::class, 'currentUser']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{user}', [UserController::class, 'show']);

    // Chat message routes
    Route::get('/messages/{user}', [ChatMessageController::class, 'index']);
    Route::post('/messages/{user}', [ChatMessageController::class, 'store']);
});

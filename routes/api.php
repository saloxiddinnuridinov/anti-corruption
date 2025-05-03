<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AppealController;
use App\Http\Controllers\API\ContentController;

Route::prefix('v1')->group(function () {
    // Auth routes
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    // Authenticated routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user', [AuthController::class, 'user']);

        // Appeals
        Route::get('/appeal/types', [AppealController::class, 'types']);
        Route::post('/appeals', [AppealController::class, 'store']);
        Route::get('/appeals', [AppealController::class, 'index']);
        Route::get('/appeals/{id}', [AppealController::class, 'show']);
    });

    // Public content routes
    Route::get('/news', [ContentController::class, 'news']);
    Route::get('/news/{id}', [ContentController::class, 'newsItem']);
    Route::get('/announcements', [ContentController::class, 'announcements']);
    Route::get('/announcements/{id}', [ContentController::class, 'announcementItem']);
});

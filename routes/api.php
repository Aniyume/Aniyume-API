<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\AnimeController;
use App\Http\Controllers\Api\V1\EpisodeController;

Route::prefix('v1')->group(function () {
    
    Route::get('/anime', [AnimeController::class, 'index']);
    Route::get('/anime/search', [AnimeController::class, 'search']);
    Route::get('/anime/{anime}', [AnimeController::class, 'show']);
    Route::get('/anime/{anime}/episodes', [EpisodeController::class, 'getByAnime']);
    
    Route::get('/episodes', [EpisodeController::class, 'index']);
    Route::get('/episodes/{episode}', [EpisodeController::class, 'show']);
    Route::get('/episodes/{episode}/player', [EpisodeController::class, 'getPlayer']);
    
    Route::get('/genres', [AnimeController::class, 'genres']);
    Route::get('/studios', [AnimeController::class, 'studios']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout']);
        
        Route::get('/user', [AuthController::class, 'me']);
    });
});

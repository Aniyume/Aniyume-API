<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AnimeController;
use App\Http\Controllers\Api\V1\EpisodeController;

Route::prefix('v1')->group(function () {
    Route::get('anime', [AnimeController::class, 'index']);
    Route::get('anime/{anime:slug}', [AnimeController::class, 'show']);
    Route::get('genres', [AnimeController::class, 'genres']);
    Route::get('studios', [AnimeController::class, 'studios']);
    Route::get('episodes', [EpisodeController::class, 'index']);
    Route::get('episodes/{episode}', [EpisodeController::class, 'show']);
    Route::get('anime/{anime:slug}/episodes', [EpisodeController::class, 'getByAnime']);
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('history', [AnimeController::class, 'addToHistory']);
        Route::get('history', [AnimeController::class, 'getHistory']);
        Route::post('favorites', [AnimeController::class, 'addFavorite']);
        Route::get('favorites', [AnimeController::class, 'getFavorites']);
    });
});

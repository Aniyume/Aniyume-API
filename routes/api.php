<?php

use App\Http\Controllers\Api\V1\AnimeController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\EpisodeController;
use App\Http\Controllers\Api\V1\FavoritesController;
use App\Http\Controllers\Api\V1\TagController;
use App\Http\Controllers\Api\V1\UserAnimeListController;
use App\Http\Controllers\Api\V1\UserProfileController;
use App\Http\Controllers\Api\V1\UserStatisticsController;
use App\Http\Controllers\Api\V1\WatchHistoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('public')->group(function () {
        Route::get('/anime', [AnimeController::class, 'index']);
        Route::get('/episodes/translators', [EpisodeController::class, 'getAllTranslators']);
        Route::get('/episodes', [EpisodeController::class, 'index']);
        Route::get('/tags', [TagController::class, 'index']);
        Route::get('/anime/{id}', [AnimeController::class, 'show']);
        Route::get('/anime/{anime}/episodes', [EpisodeController::class, 'getByAnime']);
        Route::get('/anime/{anime}/community-stats', [AnimeController::class, 'getCommunityStats']);
        Route::get('/episodes/{episode}', [EpisodeController::class, 'show'])
            ->where('episode', '[0-9]+');
        Route::get('/episodes/{episode}/player', [EpisodeController::class, 'getPlayer'])
            ->where('episode', '[0-9]+');
        Route::get('/users/{userId}/statistics', [UserStatisticsController::class, 'getStatistics']);
    });

    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', [AuthController::class, 'me']);
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::get('/profile/me', [UserProfileController::class, 'getFullProfile']);
        Route::get('/statistics/me', [UserStatisticsController::class, 'getStatistics']);

        Route::post('/anime/{anime}/status', [UserAnimeListController::class, 'updateStatus']);
        Route::get('/anime/{anime}/user-status', [UserAnimeListController::class, 'getUserStatus']);
        Route::patch('/anime/{anime}/episodes-watched/{episodesWatched}', [UserAnimeListController::class, 'updateEpisodesWatched']);
        Route::get('/my-anime-list/{status?}', [UserAnimeListController::class, 'getList']);

        Route::get('/favorites/{anime_id}/check', [FavoritesController::class, 'checkFavorite']);
        Route::get('/watch-history/anime/{anime_id}', [WatchHistoryController::class, 'getByAnime']);

        Route::apiResource('favorites', FavoritesController::class);
        Route::apiResource('watch-history', WatchHistoryController::class);
    });
});

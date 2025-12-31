<?php

use App\Http\Controllers\Api\V1\AnimeController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\EpisodeController;
use App\Http\Controllers\Api\V1\FavoritesController;
use App\Http\Controllers\Api\V1\RatingsController;
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
        Route::get('/anime/{anime}', [AnimeController::class, 'show']);

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

        // Profile
        Route::get('/profile/me', [UserProfileController::class, 'getFullProfile']);
        Route::put('/profile/me', [UserProfileController::class, 'update']);
        Route::post('/profile/me/avatar', [UserProfileController::class, 'uploadAvatar']);

        // Statistics
        Route::get('/statistics/me', [UserStatisticsController::class, 'getStatistics']);
        Route::get('/statistics/me/episodes-summary', [UserStatisticsController::class, 'getEpisodesSummary']);

        // Anime list
        Route::post('/anime/{anime}/status', [UserAnimeListController::class, 'updateStatus']);
        Route::get('/anime/{anime}/user-status', [UserAnimeListController::class, 'getUserStatus']);
        Route::patch('/anime/{anime}/episodes-watched/{episodesWatched}', [UserAnimeListController::class, 'updateEpisodesWatched']);
        Route::get('/my-anime-list/{status?}', [UserAnimeListController::class, 'getList']);

        // Favorites
        Route::get('/favorites', [FavoritesController::class, 'index']);
        Route::post('/favorites', [FavoritesController::class, 'store']);
        Route::delete('/favorites/{animeId}', [FavoritesController::class, 'destroy']);
        Route::get('/favorites/{animeId}/check', [FavoritesController::class, 'checkFavorite']);

        // Watch history
        Route::prefix('watch-history')->controller(WatchHistoryController::class)->group(function () {
            Route::get('/', 'index')->name('watch-history.index');
            Route::post('/', 'store')->name('watch-history.store');
            Route::get('/{id}', 'show')->name('watch-history.show');
            Route::delete('/{id}', 'destroy')->name('watch-history.destroy');
            Route::get('/anime/{animeId}/history', 'getByAnime')->name('watch-history.by-anime');
            Route::get('/anime/{animeId}/last-episode', 'getLastWatchedEpisode')->name('watch-history.last-episode');
        });

        // Ratings
        Route::prefix('ratings')->controller(RatingsController::class)->group(function () {
            Route::get('/', 'index')->name('ratings.index');
            Route::post('/', 'store')->name('ratings.store');
            Route::delete('/{rating}', 'destroy')->name('ratings.destroy');
            Route::get('/anime/{animeId}', 'getUserRating')->name('ratings.get-user-rating');
        });

        // Anime list extended
        Route::prefix('anime-list')->controller(UserAnimeListController::class)->group(function () {
            Route::get('/{status?}', 'getList')->name('anime-list.get');
            Route::get('/anime/{anime}/status', 'getUserStatus')->name('anime-list.status');
            Route::put('/anime/{anime}/status', 'updateStatus')->name('anime-list.update-status');
            Route::put('/anime/{anime}/watched', 'updateEpisodesWatched')->name('anime-list.update-watched');
        });
    });
});

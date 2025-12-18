<?php

use App\Http\Controllers\Api\V1\Admin\AnimeController as AdminAnimeController;
use App\Http\Controllers\Api\V1\AnimeController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CommentsController;
use App\Http\Controllers\Api\V1\EpisodeController;
use App\Http\Controllers\Api\V1\FavoritesController;
use App\Http\Controllers\Api\V1\RatingsController;
use App\Http\Controllers\Api\V1\TagController;
use App\Http\Controllers\Api\V1\UserProfileController;
use App\Http\Controllers\Api\V1\WatchHistoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/health', function () {
        return response()->json(['status' => 'ok']);
    });

    Route::prefix('public')->group(function () {
        Route::get('/anime', [AnimeController::class, 'index']);
        Route::get('/anime/search', [AnimeController::class, 'search']);
        Route::get('/anime/{anime}', [AnimeController::class, 'show']);
        Route::get('/anime/{anime}/episodes', [EpisodeController::class, 'getByAnime']);
        Route::get('/tags/all', [TagController::class, 'all']);
        Route::get('/tags', [TagController::class, 'index']);
        Route::get('/tags/{id}', [TagController::class, 'show']);
        Route::get('/episodes/translators', [EpisodeController::class, 'getAllTranslators']);
        Route::get('/episodes', [EpisodeController::class, 'index']);
        Route::get('/episodes/{episode}', [EpisodeController::class, 'show']);
        Route::get('/episodes/{episode}/player', [EpisodeController::class, 'getPlayer']);

        Route::get('/genres', [AnimeController::class, 'genres']);
        Route::get('/studios', [AnimeController::class, 'studios']);
    });

    Route::middleware('throttle:6,1')->group(function () {
        Route::post('/auth/register', [AuthController::class, 'register']);
        Route::post('/auth/login', [AuthController::class, 'login']);
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::get('/user', [AuthController::class, 'me']);

        Route::prefix('profile')->group(function () {
            Route::get('/stats', [UserProfileController::class, 'stats']);
            Route::get('/activity', [UserProfileController::class, 'activity']);
        });

        Route::prefix('favorites')->group(function () {
            Route::get('/', [FavoritesController::class, 'index']);
            Route::post('/', [FavoritesController::class, 'store']);
            Route::get('/{animeId}/check', [FavoritesController::class, 'check']);
            Route::delete('/{animeId}', [FavoritesController::class, 'destroy']);
        });

        Route::prefix('watch-history')->group(function () {
            Route::get('/', [WatchHistoryController::class, 'index']);
            Route::post('/', [WatchHistoryController::class, 'store']);
            Route::get('/anime/{animeId}', [WatchHistoryController::class, 'getByAnime']);
            Route::patch('/{watchHistory}', [WatchHistoryController::class, 'update']);
            Route::delete('/{watchHistory}', [WatchHistoryController::class, 'destroy']);
        });

        Route::prefix('comments')->group(function () {
            Route::get('/my', [CommentsController::class, 'userComments']);
            Route::post('/', [CommentsController::class, 'store']);
            Route::patch('/{comment}', [CommentsController::class, 'update']);
            Route::delete('/{comment}', [CommentsController::class, 'destroy']);
        });

        Route::prefix('ratings')->group(function () {
            Route::get('/', [RatingsController::class, 'index']);
            Route::post('/', [RatingsController::class, 'store']);
            Route::get('/anime/{animeId}', [RatingsController::class, 'getUserRating']);
            Route::delete('/{rating}', [RatingsController::class, 'destroy']);
        });

        Route::middleware('admin')->prefix('admin')->group(function () {
            Route::prefix('anime')->group(function () {
                Route::get('/', [AdminAnimeController::class, 'index']);
                Route::post('/', [AdminAnimeController::class, 'store']);
                Route::get('/{id}', [AdminAnimeController::class, 'show']);
                Route::patch('/{id}', [AdminAnimeController::class, 'update']);
                Route::delete('/{id}', [AdminAnimeController::class, 'destroy']);
            });
        });
    });
});

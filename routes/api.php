<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AnimeController;
use App\Http\Controllers\Api\V1\EpisodeController;
use App\Http\Controllers\Api\V1\WatchHistoryController;
use App\Http\Controllers\Api\V1\FavoritesController;
use App\Http\Controllers\Api\V1\RatingsController;
use App\Http\Controllers\Api\V1\CommentsController;

Route::prefix('v1')->group(function () {
    Route::get('anime', [AnimeController::class, 'index']);
    Route::get('anime/{anime:slug}', [AnimeController::class, 'show']);
    Route::get('genres', [AnimeController::class, 'genres']);
    Route::get('studios', [AnimeController::class, 'studios']);
    Route::get('episodes', [EpisodeController::class, 'index']);
    Route::get('episodes/{episode}', [EpisodeController::class, 'show']);
    Route::get('anime/{anime:slug}/episodes', [EpisodeController::class, 'getByAnime']);
    Route::get('anime/{animeSlug}/comments', [CommentsController::class, 'index']);
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('watch-history', [WatchHistoryController::class, 'index']);
        Route::post('watch-history', [WatchHistoryController::class, 'store']);
        Route::put('watch-history/{watchHistory}', [WatchHistoryController::class, 'update']);
        Route::delete('watch-history/{watchHistory}', [WatchHistoryController::class, 'destroy']);
        Route::get('watch-history/anime/{animeId}', [WatchHistoryController::class, 'getByAnime']);
        Route::get('favorites', [FavoritesController::class, 'index']);
        Route::post('favorites', [FavoritesController::class, 'store']);
        Route::delete('favorites/{animeId}', [FavoritesController::class, 'destroy']);
        Route::get('favorites/check/{animeId}', [FavoritesController::class, 'check']);
        Route::get('ratings', [RatingsController::class, 'index']);
        Route::post('ratings', [RatingsController::class, 'store']);
        Route::delete('ratings/{animeId}', [RatingsController::class, 'destroy']);
        Route::get('ratings/anime/{animeId}', [RatingsController::class, 'getUserRating']);
        Route::post('comments', [CommentsController::class, 'store']);
        Route::put('comments/{comment}', [CommentsController::class, 'update']);
        Route::delete('comments/{comment}', [CommentsController::class, 'destroy']);
        Route::get('my-comments', [CommentsController::class, 'userComments']);
    });
});

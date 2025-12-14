<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AnimeController;
use App\Http\Controllers\Api\V1\EpisodeController;
use App\Http\Controllers\Api\V1\WatchHistoryController;
use App\Http\Controllers\Api\V1\FavoritesController;
use App\Http\Controllers\Api\V1\RatingsController;
use App\Http\Controllers\Api\V1\CommentsController;
use App\Http\Controllers\Api\V1\UserProfileController;

Route::prefix('v1')->group(function () {
    
    // Anime routes
    Route::get('anime', [AnimeController::class, 'index']);
    Route::get('anime/search', [AnimeController::class, 'search']);
    Route::get('anime/{anime:slug}', [AnimeController::class, 'show']);
    Route::get('genres', [AnimeController::class, 'genres']);
    Route::get('studios', [AnimeController::class, 'studios']);
    
    // Episodes routes
    Route::get('episodes', [EpisodeController::class, 'index']);
    Route::get('episodes/{episode}', [EpisodeController::class, 'show']);
    Route::get('anime/{anime:slug}/episodes', [EpisodeController::class, 'getByAnime']);
    
    // Comments routes (public read)
    Route::get('anime/{animeSlug}/comments', [CommentsController::class, 'index']);
    
    // Authenticated routes
    Route::middleware(['auth:sanctum'])->group(function () {
        
        // User Profile
        Route::get('profile/stats', [UserProfileController::class, 'stats']);
        Route::get('profile/activity', [UserProfileController::class, 'activity']);
        
        // Watch History
        Route::get('watch-history', [WatchHistoryController::class, 'index']);
        Route::post('watch-history', [WatchHistoryController::class, 'store']);
        Route::put('watch-history/{watchHistory}', [WatchHistoryController::class, 'update']);
        Route::delete('watch-history/{watchHistory}', [WatchHistoryController::class, 'destroy']);
        Route::get('watch-history/anime/{animeId}', [WatchHistoryController::class, 'getByAnime']);
        
        // Favorites
        Route::get('favorites', [FavoritesController::class, 'index']);
        Route::post('favorites', [FavoritesController::class, 'store']);
        Route::delete('favorites/{animeId}', [FavoritesController::class, 'destroy']);
        Route::get('favorites/check/{animeId}', [FavoritesController::class, 'check']);
        
        // Ratings
        Route::get('ratings', [RatingsController::class, 'index']);
        Route::post('ratings', [RatingsController::class, 'store']);
        Route::delete('ratings/{animeId}', [RatingsController::class, 'destroy']);
        Route::get('ratings/anime/{animeId}', [RatingsController::class, 'getUserRating']);
        
        // Comments
        Route::post('comments', [CommentsController::class, 'store']);
        Route::put('comments/{comment}', [CommentsController::class, 'update']);
        Route::delete('comments/{comment}', [CommentsController::class, 'destroy']);
        Route::get('my-comments', [CommentsController::class, 'userComments']);
    });
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\AnimeController;
use App\Http\Controllers\Api\V1\EpisodeController;
use App\Http\Controllers\Api\V1\WatchHistoryController;
use App\Http\Controllers\Api\V1\FavoriteController;
use App\Http\Controllers\Api\V1\RatingController;
use App\Http\Controllers\Api\V1\CommentController;
use App\Http\Controllers\Api\V1\UserProfileController;

Route::prefix('v1')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/anime', [AnimeController::class, 'index']);
    Route::get('/anime/search', [AnimeController::class, 'search']);
    Route::get('/anime/{id}', [AnimeController::class, 'show']);
    Route::get('/anime/{id}/episodes', [EpisodeController::class, 'index']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user', [AuthController::class, 'me']);
        Route::get('/user/profile', [UserProfileController::class, 'show']);

        Route::get('/watch-history', [WatchHistoryController::class, 'index']);
        Route::post('/watch-history', [WatchHistoryController::class, 'store']);

        Route::get('/favorites', [FavoriteController::class, 'index']);
        Route::post('/favorites', [FavoriteController::class, 'store']);
        Route::delete('/favorites/{anime_id}', [FavoriteController::class, 'destroy']);

        Route::get('/ratings', [RatingController::class, 'index']);
        Route::post('/ratings', [RatingController::class, 'store']);
        Route::delete('/ratings/{anime_id}', [RatingController::class, 'destroy']);

        Route::get('/comments', [CommentController::class, 'index']);
        Route::post('/comments', [CommentController::class, 'store']);
        Route::delete('/comments/{id}', [CommentController::class, 'destroy']);

        Route::get('/anime/{anime_id}/comments', [CommentController::class, 'animeComments']);
    });
});

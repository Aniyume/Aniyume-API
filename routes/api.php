<?php

use App\Http\Controllers\Api\Admin\AnimeController as AdminAnimeController;
use App\Http\Controllers\Api\Admin\AuditLogController as AdminAuditLogController;
use App\Http\Controllers\Api\Admin\AuthMeController as AdminAuthMeController;
use App\Http\Controllers\Api\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Api\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Api\Admin\EpisodeController as AdminEpisodeController;
use App\Http\Controllers\Api\Admin\ImportController as AdminImportController;
use App\Http\Controllers\Api\Admin\RatingController as AdminRatingController;
use App\Http\Controllers\Api\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Api\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Api\Admin\TagController as AdminTagController;
use App\Http\Controllers\Api\Admin\UserController as AdminUserController;
use App\Http\Controllers\Api\V1\AiChatController;
use App\Http\Controllers\Api\V1\AiChatSessionController;
use App\Http\Controllers\Api\V1\AnimeController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CommentsController;
use App\Http\Controllers\Api\V1\ContactMessageController;
use App\Http\Controllers\Api\V1\EpisodeController;
use App\Http\Controllers\Api\V1\FavoritesController;
use App\Http\Controllers\Api\V1\FriendshipController;
use App\Http\Controllers\Api\V1\RatingsController;
use App\Http\Controllers\Api\V1\ReportController as PublicReportController;
use App\Http\Controllers\Api\V1\ScheduleController;
use App\Http\Controllers\Api\V1\StreamProxyController;
use App\Http\Controllers\Api\V1\TagController;
use App\Http\Controllers\Api\V1\UserAnimeListController;
use App\Http\Controllers\Api\V1\UserProfileController;
use App\Http\Controllers\Api\V1\UserStatisticsController;
use App\Http\Controllers\Api\V1\WatchHistoryController;
use App\Http\Controllers\Api\V1\WatchPartyController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Broadcast::routes(['middleware' => ['auth:sanctum']]);

    // Honeypot Trap - Any bot hitting this will be flagged
    Route::post('/trap', function () {
        return response()->json(['success' => true]);
    });

    Route::prefix('public')->group(function () {
        Route::get('/anime', [AnimeController::class, 'index']);
        Route::get('/schedule', [ScheduleController::class, 'index']);
        Route::get('/episodes/translators', [EpisodeController::class, 'getAllTranslators']);
        Route::get('/episodes', [EpisodeController::class, 'index']);
        Route::get('/tags', [TagController::class, 'index']);
        Route::get('/anime/{anime}', [AnimeController::class, 'show']);
        Route::get('/anime/{anime}/banner', [AnimeController::class, 'getBanner']);
        Route::get('/anime/{anime}/comments', [CommentsController::class, 'index']);

        Route::get('/anime/{anime}/episodes', [EpisodeController::class, 'getByAnime']);
        Route::get('/anime/{anime}/episodes/{episodeNumber}/sources', [EpisodeController::class, 'getPlayerSources']);
        Route::get('/anime/{anime}/community-stats', [AnimeController::class, 'getCommunityStats']);
        Route::get('/anime/{anime}/recommendations', [AnimeController::class, 'getRecommendations']);
        Route::match(['get', 'options'], '/stream/allanime/{encoded}', [StreamProxyController::class, 'allanime'])
            ->where('encoded', '[A-Za-z0-9\-_]+');
        Route::get('/episodes/{episode}', [EpisodeController::class, 'show'])
            ->where('episode', '[0-9]+');
        Route::get('/episodes/{episode}/player', [EpisodeController::class, 'getPlayer'])
            ->where('episode', '[0-9]+');
        Route::get('/users/{userId}/statistics', [UserStatisticsController::class, 'getStatistics']);
    });

    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/login', [AuthController::class, 'login']);
    Route::post('/contacts', [ContactMessageController::class, 'store']);

    Route::prefix('admin')
        ->middleware(['clerk.admin'])
        ->group(function () {
            Route::get('/auth/me', AdminAuthMeController::class);
            Route::get('/dashboard', AdminDashboardController::class);
            Route::get('/anime', [AdminAnimeController::class, 'index']);
            Route::get('/anime/{anime}', [AdminAnimeController::class, 'show']);
            Route::post('/anime', [AdminAnimeController::class, 'store']);
            Route::match(['put', 'patch'], '/anime/{anime}', [AdminAnimeController::class, 'update']);
            Route::delete('/anime/{anime}', [AdminAnimeController::class, 'destroy']);
            Route::post('/anime/{anime}/poster', [AdminAnimeController::class, 'uploadPoster']);
            Route::delete('/anime/{anime}/poster', [AdminAnimeController::class, 'deletePoster']);
            Route::post('/anime/{anime}/cover', [AdminAnimeController::class, 'uploadCover']);
            Route::delete('/anime/{anime}/cover', [AdminAnimeController::class, 'deleteCover']);
            Route::post('/anime/banners/enrich', [AdminAnimeController::class, 'enrichBanners']);
            Route::get('/anime/{anime}/banner-candidates', [AdminAnimeController::class, 'bannerCandidates']);
            Route::post('/anime/{anime}/banner/apply', [AdminAnimeController::class, 'applyBanner']);
            Route::patch('/anime/{anime}/cover-lock', [AdminAnimeController::class, 'lockCover']);
            Route::get('/tags', [AdminTagController::class, 'index']);
            Route::get('/tags/{tag}', [AdminTagController::class, 'show']);
            Route::post('/tags', [AdminTagController::class, 'store']);
            Route::match(['put', 'patch'], '/tags/{tag}', [AdminTagController::class, 'update']);
            Route::delete('/tags/{tag}', [AdminTagController::class, 'destroy']);
            Route::get('/users', [AdminUserController::class, 'index']);
            Route::post('/users/premium/grant', [AdminUserController::class, 'grantPremiumByNickname']);
            Route::get('/users/{user}', [AdminUserController::class, 'show']);
            Route::patch('/users/{user}/profile', [AdminUserController::class, 'updateProfile']);
            Route::post('/users/{user}/avatar', [AdminUserController::class, 'uploadAvatar']);
            Route::delete('/users/{user}/avatar', [AdminUserController::class, 'deleteAvatar']);
            Route::patch('/users/{user}/premium', [AdminUserController::class, 'updatePremium']);
            Route::post('/users/{user}/ban', [AdminUserController::class, 'ban']);
            Route::post('/users/{user}/unban', [AdminUserController::class, 'unban']);
            Route::delete('/users/{user}', [AdminUserController::class, 'destroy']);
            Route::get('/comments', [AdminCommentController::class, 'index']);
            Route::post('/comments/{comment}/approve', [AdminCommentController::class, 'approve']);
            Route::post('/comments/{comment}/reject', [AdminCommentController::class, 'reject']);
            Route::post('/comments/{comment}/heart', [AdminCommentController::class, 'toggleHeart']);
            Route::delete('/comments/{comment}', [AdminCommentController::class, 'destroy']);
            Route::get('/audit-logs', [AdminAuditLogController::class, 'index']);
            Route::get('/episodes', [AdminEpisodeController::class, 'index']);
            Route::get('/episodes/player-diagnostics', [AdminEpisodeController::class, 'playerDiagnostics']);
            Route::get('/episodes/{episode}', [AdminEpisodeController::class, 'show']);
            Route::match(['put', 'patch'], '/episodes/{episode}', [AdminEpisodeController::class, 'update']);
            Route::delete('/episodes/{episode}', [AdminEpisodeController::class, 'destroy']);
            Route::post('/episodes/import-all', [AdminEpisodeController::class, 'bulkImport']);
            Route::post('/episodes/import/{anime}', [AdminEpisodeController::class, 'importForAnime']);
            Route::get('/reports', [AdminReportController::class, 'index']);
            Route::get('/reports/{report}', [AdminReportController::class, 'show']);
            Route::patch('/reports/{report}/status', [AdminReportController::class, 'updateStatus']);
            Route::delete('/reports/{report}', [AdminReportController::class, 'destroy']);
            Route::get('/ratings', [AdminRatingController::class, 'index']);
            Route::delete('/ratings/{rating}', [AdminRatingController::class, 'destroy']);
            Route::get('/contacts', [\App\Http\Controllers\Api\Admin\ContactMessageController::class, 'index']);
            Route::get('/contacts/{contact}/photo', [\App\Http\Controllers\Api\Admin\ContactMessageController::class, 'photo']);
            Route::patch('/contacts/{contact}/status', [\App\Http\Controllers\Api\Admin\ContactMessageController::class, 'updateStatus']);
            Route::delete('/contacts/{contact}', [\App\Http\Controllers\Api\Admin\ContactMessageController::class, 'destroy']);
            Route::get('/settings', [AdminSettingController::class, 'index']);
            Route::patch('/settings', [AdminSettingController::class, 'update']);
            Route::get('/settings/diagnostics', [AdminSettingController::class, 'diagnostics']);
            Route::get('/imports/dashboard', [AdminImportController::class, 'dashboard']);
            Route::get('/imports/logs', [AdminImportController::class, 'logs']);
            Route::post('/imports/run', [AdminImportController::class, 'run']);
        });

    Route::middleware(['auth:sanctum', 'not_banned'])->group(function () {
        Route::get('/user', [AuthController::class, 'me']);
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::post('/ai/chat', AiChatController::class)->middleware('throttle:ai');
        Route::get('/ai/chat/sessions', [AiChatSessionController::class, 'index']);
        Route::get('/ai/chat/sessions/{sessionId}', [AiChatSessionController::class, 'show']);
        Route::get('/my-comments', [CommentsController::class, 'userComments']);
        Route::post('/comments/{comment}/reactions', [CommentsController::class, 'react']);
        Route::post('/comments/{comment}/admin-heart', [CommentsController::class, 'adminHeart']);
        Route::post('/comments/{comment}/replies', [CommentsController::class, 'reply']);
        Route::apiResource('comments', CommentsController::class)->only(['store', 'update', 'destroy']);
        Route::post('/reports', [PublicReportController::class, 'store']);

        Route::get('/profile/me', [UserProfileController::class, 'getFullProfile']);
        Route::put('/profile/me', [UserProfileController::class, 'update']);
        Route::post('/profile/me/avatar', [UserProfileController::class, 'uploadAvatar']);
        Route::get('/profile/me/frames', [UserProfileController::class, 'frames']);
        Route::post('/profile/me/frames/select', [UserProfileController::class, 'selectFrame']);

        Route::get('/statistics/me', [UserStatisticsController::class, 'getStatistics']);
        Route::get('/statistics/me/episodes-summary', [UserStatisticsController::class, 'getEpisodesSummary']);

        Route::post('/anime/{anime}/status', [UserAnimeListController::class, 'updateStatus']);
        Route::get('/anime/{anime}/user-status', [UserAnimeListController::class, 'getUserStatus']);
        Route::patch('/anime/{anime}/episodes-watched/{episodesWatched}', [UserAnimeListController::class, 'updateEpisodesWatched']);
        Route::get('/my-anime-list/{status?}', [UserAnimeListController::class, 'getList']);

        Route::get('/favorites', [FavoritesController::class, 'index']);
        Route::post('/favorites', [FavoritesController::class, 'store']);
        Route::delete('/favorites/{animeId}', [FavoritesController::class, 'destroy']);
        Route::get('/favorites/{animeId}/check', [FavoritesController::class, 'checkFavorite']);

        Route::prefix('watch-history')->controller(WatchHistoryController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::delete('/{id}', 'destroy');
            Route::get('/anime/{animeId}/history', 'getByAnime');
            Route::get('/anime/{animeId}/last-episode', 'getLastWatchedEpisode');
        });

        Route::prefix('ratings')->controller(RatingsController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::delete('/{rating}', 'destroy');
            Route::get('/anime/{animeId}', 'getUserRating');
        });

        // === Friends ===
        Route::prefix('friends')->controller(FriendshipController::class)->group(function () {
            Route::get('/', 'index');                          // GET /friends
            Route::get('/requests', 'requests');               // GET /friends/requests
            Route::get('/requests/count', 'requestsCount');    // GET /friends/requests/count
            Route::post('/by-nickname', 'sendByNickname');     // POST /friends/by-nickname
            Route::post('/{userId}', 'send');                  // POST /friends/{userId}
            Route::post('/{userId}/accept', 'accept');         // POST /friends/{userId}/accept
            Route::post('/{userId}/decline', 'decline');       // POST /friends/{userId}/decline
            Route::get('/{userId}/status', 'status');          // GET /friends/{userId}/status
        });
        Route::get('/users/search', [FriendshipController::class, 'search']); // GET /users/search?q=
        Route::get('/users/{userId}/profile', [FriendshipController::class, 'profile'])
            ->where('userId', '[0-9]+');

        // === Watch Party ===
        Route::prefix('watch-party')->controller(WatchPartyController::class)->group(function () {
            Route::post('/', 'create');                        // POST /watch-party
            Route::get('/{code}', 'show');                    // GET /watch-party/{code}
            Route::post('/{code}/join', 'join');               // POST /watch-party/{code}/join
            Route::post('/{code}/leave', 'leave');             // POST /watch-party/{code}/leave
            Route::post('/{code}/sync', 'sync');               // POST /watch-party/{code}/sync
            Route::post('/{code}/message', 'sendMessage');     // POST /watch-party/{code}/message
            Route::get('/{code}/messages', 'getMessages');     // GET /watch-party/{code}/messages
            Route::post('/{code}/invite', 'invite');           // POST /watch-party/{code}/invite
            Route::delete('/{code}', 'close');                 // DELETE /watch-party/{code}
        });

        // === Payment ===
        Route::post('/payment/premium', [PaymentController::class, 'subscribeToPremium']);
    });
});

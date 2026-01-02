<?php

use App\Http\Controllers\Admin\AnimeManagementController;
use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CommentModerationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EpisodeManagementController;
use App\Http\Controllers\Admin\ImportManagementController;
use App\Http\Controllers\Admin\TagManagementController;
use App\Http\Controllers\Admin\UserManagementController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin/login');
});

Route::get('/login', function () {
    return response()->json(['message' => 'Unauthenticated.'], 401);
})->name('login');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');

    Route::middleware(['auth'])->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('users', UserManagementController::class);
        Route::post('users/{user}/ban', [UserManagementController::class, 'ban'])->name('users.ban');
        Route::post('users/{user}/unban', [UserManagementController::class, 'unban'])->name('users.unban');
        Route::post('anime/bulk-delete', [AnimeManagementController::class, 'bulkDestroy'])->name('bulk-delete');
        Route::resource('anime', AnimeManagementController::class);
        Route::resource('tags', TagManagementController::class)->except(['show']);

        Route::prefix('episodes')->name('episodes.')->group(function () {
            Route::get('/', [EpisodeManagementController::class, 'index'])->name('index');
            Route::get('/{episode}/edit', [EpisodeManagementController::class, 'edit'])->name('edit');
            Route::put('/{episode}', [EpisodeManagementController::class, 'update'])->name('update');
            Route::post('/import-all', [EpisodeManagementController::class, 'importAll'])->name('import-all');
            Route::post('/{anime}/import', [EpisodeManagementController::class, 'importForAnime'])->name('import-for-anime');
            Route::post('/bulk-import', [EpisodeManagementController::class, 'bulkImport'])->name('bulk-import');
            Route::delete('/{id}', [EpisodeManagementController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('comments')->name('comments.')->group(function () {
            Route::get('/', [CommentModerationController::class, 'index'])->name('index');
            Route::post('/{comment}/approve', [CommentModerationController::class, 'approve'])->name('approve');
            Route::post('/{comment}/reject', [CommentModerationController::class, 'reject'])->name('reject');
            Route::delete('/{comment}', [CommentModerationController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('import')->name('import.')->group(function () {
            Route::get('/', [ImportManagementController::class, 'index'])->name('index');
            Route::post('run', [ImportManagementController::class, 'run'])->name('run');
            Route::get('logs', [ImportManagementController::class, 'logs'])->name('logs');
        });

        Route::get('audit-logs', [AuditLogController::class, 'index'])->name('audit-logs');
    });
});

<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

$adminWebUrl = rtrim(config('app.admin_web_url'), '/');

Route::get('/', function () use ($adminWebUrl) {
    return redirect($adminWebUrl);
});

Route::get('/login', function () {
    return response()->json(['message' => 'Unauthenticated.'], 401);
})->name('login');

Route::get('/ready', function () {
    try {
        DB::select('select 1');
        Cache::put('health:ready', true, 10);

        if (! Cache::get('health:ready')) {
            throw new RuntimeException('Cache write check failed.');
        }

        return response()->json(['status' => 'ready']);
    } catch (Throwable $exception) {
        report($exception);

        return response()->json(['status' => 'not_ready'], 503);
    }
});

Route::get('/admin/{path?}', function (?string $path = null) use ($adminWebUrl) {
    $target = $path ? $adminWebUrl.'/'.ltrim($path, '/') : $adminWebUrl;

    return redirect($target);
})->where('path', '.*')->name('admin.redirect');

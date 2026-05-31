<?php

use Illuminate\Support\Facades\Route;

$adminWebUrl = rtrim(config('app.admin_web_url'), '/');

Route::get('/', function () use ($adminWebUrl) {
    return redirect($adminWebUrl);
});

Route::get('/login', function () {
    return response()->json(['message' => 'Unauthenticated.'], 401);
})->name('login');

Route::get('/admin/{path?}', function (?string $path = null) use ($adminWebUrl) {
    $target = $path ? $adminWebUrl.'/'.ltrim($path, '/') : $adminWebUrl;

    return redirect($target);
})->where('path', '.*')->name('admin.redirect');

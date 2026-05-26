<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Ежедневный запуск маппинга новых аниме из Shikimori в 3:00
Schedule::command('import:anime')->dailyAt('03:00');

// Ежечасный поиск новых серий у онгоингов
Schedule::command('import:episodes --limit=200')->hourly();

// Синхронизация ближайших онгоингов, legacy schedule перенесён из app/Console/Kernel.php
Schedule::command('episodes:sync-ongoing --days=1')->everySixHours();

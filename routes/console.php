<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Ежечасный запуск маппинга новых аниме из Shikimori
Schedule::command('import:anime')->hourlyAt(5)->withoutOverlapping();

// Ежечасный поиск новых серий у онгоингов
Schedule::command('import:episodes --limit=200')->hourlyAt(20)->withoutOverlapping();

// Ежечасное улучшение отсутствующих баннеров
Schedule::command('anime:enrich-banners --only-missing --limit=100')->hourlyAt(35)->withoutOverlapping();

// Синхронизация ближайших онгоингов, legacy schedule перенесён из app/Console/Kernel.php
Schedule::command('episodes:sync-ongoing --days=1')->everySixHours()->withoutOverlapping();

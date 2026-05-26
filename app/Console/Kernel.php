<?php

// Laravel 12 schedules commands from routes/console.php in this application.
// This legacy Kernel is kept for compatibility only; do not add scheduled
// tasks here because they will not be visible in `php artisan schedule:list`.

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\CheckAuditLogs::class,
        \App\Console\Commands\ImportEpisodes::class,
        \App\Console\Commands\ImportAnilibriaCommand::class,
        \App\Console\Commands\SyncOngoingCommand::class,
        \App\Console\Commands\CoverageReportCommand::class,
    ];

    protected function schedule(Schedule $schedule) {}

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

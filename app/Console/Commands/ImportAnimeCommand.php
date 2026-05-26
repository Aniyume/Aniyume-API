<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ShikimoriImportService;

class ImportAnimeCommand extends Command
{
    protected $signature = 'import:anime
        {--initial : Initial full import (skip already existing anime)}
        {--start-page=1 : Start from a specific page (for resuming partial imports)}';

    protected $description = 'Import anime from Shikimori API with Russian titles, descriptions, and genres';

    public function handle(ShikimoriImportService $importService): int
    {
        $isInitial = $this->option('initial') ?: false;
        $startPage = (int) $this->option('start-page');

        $this->info('🚀 Starting Shikimori anime import...');
        $this->info('   Source: Shikimori (Russian titles, descriptions, genres)');
        $this->info('   Mode: ' . ($isInitial ? 'Initial (skip existing)' : 'Update (overwrite existing)'));
        if ($startPage > 1) {
            $this->info("   Resuming from page: {$startPage}");
        }
        $this->newLine();

        $log = $importService->importAll($isInitial, $startPage);

        $this->newLine();

        if ($log->status === 'completed') {
            $this->info('✅ Import completed successfully!');
        } elseif ($log->status === 'partial') {
            $errors = json_decode($log->errors, true);
            $this->warn('⚠️  Import partially completed (rate limited by Shikimori).');
            $this->warn("   Stopped at page: " . ($errors['stopped_at_page'] ?? '?'));
            $this->info("   Resume: php artisan import:anime --start-page=" . ($errors['stopped_at_page'] ?? '?'));
        } else {
            $this->error("❌ Import failed: " . ($log->errors ?? 'Unknown error'));
        }

        $this->table(
            ['Metric', 'Count'],
            [
                ['Processed', $log->total_processed ?? 0],
                ['Created', $log->total_created ?? 0],
                ['Updated', $log->total_updated ?? 0],
                ['Skipped', $log->total_skipped ?? 0],
            ]
        );

        $totalAnime = \App\Models\Anime::count();
        $this->newLine();
        $this->info("📊 Total anime in database: {$totalAnime}");

        return $log->status === 'failed' ? 1 : 0;
    }
}

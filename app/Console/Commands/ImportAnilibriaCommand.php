<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Services\EpisodeImportService;

class ImportAnilibriaCommand extends Command
{
    protected $signature = 'episodes:import-anilibria
        {--limit=100 : Number of anime to process}
        {--update : Update existing episodes}
        {--skip-check : Skip API connectivity check}';

    protected $description = 'Import or update episodes using the multi-source priority chain (Anilibria -> Kodik -> VideoCDN)';

    public function handle(EpisodeImportService $importService)
    {
        if (!$this->option('skip-check')) {
            [$anilibriaOk, $kodikOk] = $this->checkConnectivity();

            if (!$anilibriaOk && !$kodikOk) {
                $this->error('Both Anilibria and Kodik APIs are unreachable (DNS blocked by ISP).');
                $this->line('');
                $this->line('  <comment>This command must be run on the production server, not locally.</comment>');
                $this->line('  SSH into your VPS and run:');
                $this->line('    php artisan episodes:import-anilibria --limit=100');
                return self::FAILURE;
            }

            $importService->setAvailableSources($anilibriaOk, $kodikOk);
        }

        $limit  = (int) $this->option('limit');
        $update = $this->option('update');

        $this->info("Starting episode import for up to {$limit} anime...");
        if ($update) {
            $this->info('Update mode ON — existing episodes will be overwritten.');
        }

        $importService->import($update, $limit);

        $this->info('Import completed!');
        $this->table(
            ['Metric', 'Value'],
            [
                ['Processed', $importService->processed],
                ['Created',   $importService->created],
                ['Updated',   $importService->updated],
                ['Skipped',   $importService->skipped],
                ['Errors',    $importService->errors],
            ]
        );

        return self::SUCCESS;
    }

    private function checkConnectivity(): array
    {
        $this->line('Checking API connectivity...');

        $anilibriaOk = $this->ping(
            config('services.anilibria.base_url') . '/title?id=1',
            'Anilibria'
        );

        $kodikOk = $this->ping(
            'https://kodikapi.com/search?token=' . config('services.kodik.token') . '&title=test&limit=1',
            'Kodik'
        );

        return [$anilibriaOk, $kodikOk];
    }

    private function ping(string $url, string $label): bool
    {
        try {
            // Any HTTP response (even 4xx/5xx) means the server is reachable
            Http::timeout(5)->get($url);
            $this->line("  <info>✓ {$label} reachable</info>");
            return true;
        } catch (\Throwable) {
            $this->line("  <comment>✗ {$label} unreachable (DNS/connection error)</comment>");
            return false;
        }
    }
}

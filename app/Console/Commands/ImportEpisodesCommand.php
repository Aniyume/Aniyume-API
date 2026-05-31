<?php

namespace App\Console\Commands;

use App\Services\EpisodeImportService;
use Illuminate\Console\Command;

class ImportEpisodesCommand extends Command
{
    protected $signature = 'import:episodes {--limit=100} {--offset=0} {--source= : anilibria or kodik} {--only-missing : Skip anime that already have episodes} {--clean : Wipe completely existing episodes before import}';

    protected $description = 'Import episodes from Anilibria/Kodik for existing anime with batch support';

    public function handle(EpisodeImportService $importService)
    {
        $limit = $this->option('limit') ? (int) $this->option('limit') : 100;
        $offset = $this->option('offset') ? (int) $this->option('offset') : 0;

        $source = $this->option('source');

        if ($this->option('clean')) {
            $this->warn('Wiping existing episodes...');
            $count = $importService->resetEpisodes($source);
            $this->info("Deleted $count episodes.");
            if ($limit === 0) {
                return; // just clean
            }
        }

        if ($source === 'anilibria') {
            $importService->setAvailableSources(true, false);
            $this->info('Source: Anilibria only');
        } elseif ($source === 'kodik') {
            $importService->setAvailableSources(false, true);
            $this->info('Source: Kodik only');
        }

        if ($this->option('only-missing')) {
            $importService->setOnlyMissing(true);
            $this->info('Mode: Only anime without episodes');
        }

        $this->info("Starting episodes import for $limit animes from offset $offset...");

        // update existing episodes, apply limit and offset
        $importService->import(true, $limit, $offset);

        $this->info('Episodes import finished.');
        $this->info("Processed: {$importService->processed}");
        $this->info("Created: {$importService->created}");
        $this->info("Updated: {$importService->updated}");
        $this->info("Skipped: {$importService->skipped}");
        $this->info("Errors: {$importService->errors}");
    }
}

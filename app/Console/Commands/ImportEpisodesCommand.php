<?php

namespace App\Console\Commands;

use App\Models\ImportLog;
use App\Services\EpisodeImportService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ImportEpisodesCommand extends Command
{
    protected $signature = 'import:episodes {--limit=100} {--offset=0} {--source= : anilibria or kodik} {--only-missing : Skip anime that already have episodes} {--clean : Wipe completely existing episodes before import}';

    protected $description = 'Import episodes from Anilibria/Kodik for existing anime with batch support';

    public function handle(EpisodeImportService $importService)
    {
        $lock = Cache::lock('imports:episodes', 3600);

        if (! $lock->get()) {
            $this->warn('Episodes import is already running. Skipping duplicate start.');

            return self::FAILURE;
        }

        $importLog = null;

        try {
            $limit = $this->option('limit') ? (int) $this->option('limit') : 100;
            $offset = $this->option('offset') ? (int) $this->option('offset') : 0;

            $source = $this->option('source');

            if ($this->option('clean')) {
                $this->warn('Wiping existing episodes...');
                $count = $importService->resetEpisodes($source);
                $this->info("Deleted $count episodes.");
                if ($limit === 0) {
                    return self::SUCCESS; // just clean
                }
            }

            $importLog = ImportLog::create([
                'import_type' => 'episodes',
                'started_at' => now(),
                'status' => 'running',
            ]);

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

            $importLog->update([
                'finished_at' => now(),
                'status' => $importService->errors > 0 ? 'partial' : 'completed',
                'total_processed' => $importService->processed,
                'total_created' => $importService->created,
                'total_updated' => $importService->updated,
                'total_skipped' => $importService->skipped,
                'episodes_created' => $importService->created,
                'errors' => $importService->errors > 0 ? json_encode(['errors' => $importService->errors]) : null,
            ]);

            return $importService->errors > 0 ? self::FAILURE : self::SUCCESS;
        } catch (\Throwable $exception) {
            $importLog?->update([
                'finished_at' => now(),
                'status' => 'failed',
                'errors' => json_encode(['error' => $exception->getMessage()]),
            ]);

            throw $exception;
        } finally {
            $lock->release();
        }
    }
}

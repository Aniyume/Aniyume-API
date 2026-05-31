<?php

namespace App\Console\Commands;

use App\Models\Anime;
use App\Models\ImportLog;
use App\Services\AnimeBannerEnrichmentService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class EnrichAnimeBannersCommand extends Command
{
    protected $signature = 'anime:enrich-banners
        {--limit=100 : Maximum anime records to process}
        {--only-missing : Only enrich anime without cover URL or source}
        {--force : Replace locked/manual covers too}';

    protected $description = 'Find and apply better anime banners from external sources';

    public function handle(AnimeBannerEnrichmentService $service): int
    {
        $lock = Cache::lock('imports:banners', 3600);

        if (! $lock->get()) {
            $this->warn('Banner enrichment is already running. Skipping duplicate start.');

            return self::FAILURE;
        }

        $importLog = ImportLog::create([
            'import_type' => 'banners',
            'started_at' => now(),
            'status' => 'running',
        ]);

        try {
            $limit = max(1, (int) $this->option('limit'));
            $onlyMissing = (bool) $this->option('only-missing');
            $force = (bool) $this->option('force');

            $query = Anime::query()->orderBy('id', 'asc');

            if (! $force) {
                $query->where(fn ($query) => $query->whereNull('cover_locked')->orWhere('cover_locked', false));
            }

            if ($onlyMissing) {
                $query->where(fn ($query) => $query
                    ->whereNull('cover_url')
                    ->orWhere('cover_url', '')
                    ->orWhereNull('cover_source')
                );
            }

            $processed = 0;
            $updated = 0;
            $skipped = 0;
            $failed = 0;

            $query->limit($limit)->get()->each(function (Anime $anime) use ($service, $force, &$processed, &$updated, &$skipped, &$failed) {
                $processed++;

                try {
                    $candidate = $service->bestCandidate($anime);

                    if (! $candidate) {
                        $skipped++;
                        $this->line("Skipped #{$anime->id}: no banner candidate");

                        return;
                    }

                    $service->apply($anime, $candidate['url'], $candidate['source'] ?? 'anilist', $force);
                    $updated++;
                    $this->info("Updated #{$anime->id}: {$anime->title}");
                } catch (\Throwable $exception) {
                    $failed++;
                    $this->warn("Failed #{$anime->id}: {$exception->getMessage()}");
                }
            });

            $this->info("Banner enrichment finished. processed={$processed}, updated={$updated}, skipped={$skipped}, failed={$failed}");

            $importLog->update([
                'finished_at' => now(),
                'status' => $failed > 0 ? 'partial' : 'completed',
                'total_processed' => $processed,
                'total_created' => $updated,
                'total_skipped' => $skipped,
                'banners_updated' => $updated,
                'errors' => $failed > 0 ? json_encode(['failed' => $failed]) : null,
            ]);

            return $failed > 0 ? self::FAILURE : self::SUCCESS;
        } catch (\Throwable $exception) {
            $importLog->update([
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

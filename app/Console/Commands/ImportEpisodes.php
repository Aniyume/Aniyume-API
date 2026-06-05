<?php

namespace App\Console\Commands;

use App\Models\Anime;
use App\Services\EpisodeImportService;
use Illuminate\Console\Command;

class ImportEpisodes extends Command
{
    /**
     * Backward-compatible alias for the canonical import:episodes command.
     * New scheduler/jobs should use ImportEpisodesCommand (import:episodes).
     */
    protected $signature = 'episodes:import
        {--update : Update existing episodes}
        {--limit= : Limit the number of anime to process}
        {--source=all : Source to use: all, anilibria, kodik, videocdn, allanime, external}
        {--only-missing : Only import for anime without any episodes}';

    protected $description = 'Import episodes for anime from configured episode providers';

    public function handle(EpisodeImportService $service): int
    {
        $source = strtolower($this->option('source') ?? 'all');
        $update = $this->option('update');
        $limit = $this->option('limit') ? (int) $this->option('limit') : null;
        $onlyMissing = $this->option('only-missing');

        // Configure sources
        if ($source === 'all') {
            $service->setAvailableSources(true, true);
            $service->setFallbackSources(true, true, true);
        } elseif ($source === 'anilibria') {
            $service->setAvailableSources(true, false);
            $service->setFallbackSources(false, false, false);
        } elseif ($source === 'kodik') {
            $service->setAvailableSources(false, true);
            $service->setFallbackSources(false, false, false);
        } elseif ($source === 'videocdn') {
            $service->setAvailableSources(false, false);
            $service->setFallbackSources(true, false, false);
        } elseif ($source === 'allanime') {
            $service->setAvailableSources(false, false);
            $service->setFallbackSources(false, true, false);
        } elseif ($source === 'external') {
            $service->setAvailableSources(false, false);
            $service->setFallbackSources(false, false, true);
        } else {
            $this->error('Invalid source. Use all, anilibria, kodik, videocdn, allanime or external.');

            return self::FAILURE;
        }
        $service->setOnlyMissing($onlyMissing);

        $this->info('🚀 Starting episodes import...');
        $this->info('   Sources: '.($source === 'all' ? 'Anilibria → Kodik → VideoCDN → AllAnime → External' : $source));
        if ($onlyMissing) {
            $this->info('   Mode: only anime without episodes');
        }

        $totalInDb = Anime::count();
        $total = $limit ? min($limit, $totalInDb) : $totalInDb;
        $this->newLine();
        $this->info("📊 Anime in database: {$totalInDb}".($limit ? ", will process: {$total}" : ''));

        if ($total === 0) {
            $this->error('No anime found!');

            return 1;
        }

        $bar = $this->output->createProgressBar($total);
        $bar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');

        $processed = 0;
        Anime::orderBy('id')->chunk(50, function ($animes) use ($service, $update, $bar, $limit, &$processed) {
            foreach ($animes as $anime) {
                if ($limit && $processed >= $limit) {
                    return false; // stop chunking
                }
                $service->importForSingleAnime($anime, $update);
                $bar->advance();
                $processed++;
            }
            if ($limit && $processed >= $limit) {
                return false;
            }
        });

        $bar->finish();
        $this->newLine(2);

        $this->info('✅ Import completed!');
        $this->table(
            ['Metric', 'Count'],
            [
                ['Processed', $service->processed],
                ['Created', $service->created],
                ['Updated', $service->updated],
                ['Skipped', $service->skipped],
                ['Errors', $service->errors],
            ]
        );

        return 0;
    }
}

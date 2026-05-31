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
        {--source=all : Source to use: anilibria, kodik, all}
        {--only-missing : Only import for anime without any episodes}';

    protected $description = 'Import episodes for anime from Anilibria/Kodik (priority: Anilibria > Kodik > VideoCDN)';

    public function handle(EpisodeImportService $service): int
    {
        $source = strtolower($this->option('source') ?? 'all');
        $update = $this->option('update');
        $limit = $this->option('limit') ? (int) $this->option('limit') : null;
        $onlyMissing = $this->option('only-missing');

        // Configure sources
        $anilibria = in_array($source, ['all', 'anilibria']);
        $kodik = in_array($source, ['all', 'kodik']);
        $service->setAvailableSources($anilibria, $kodik);
        $service->setOnlyMissing($onlyMissing);

        $this->info('🚀 Starting episodes import...');
        $this->info('   Sources: '.($source === 'all' ? 'Anilibria → Kodik → VideoCDN' : $source));
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

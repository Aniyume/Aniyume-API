<?php

namespace App\Console\Commands;

use App\Models\Anime;
use App\Services\EpisodeImportService;
use Illuminate\Console\Command;

class ImportEpisodes extends Command
{
    protected $signature = 'episodes:import {--update : Update existing episodes} {--limit=}';

    protected $description = 'Import episodes for anime from Kodik/AniLibria';

    public function handle(EpisodeImportService $service)
    {
        $this->info('🚀 Starting episodes import...');

        $bar = $this->output->createProgressBar();
        $bar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');

        $update = $this->option('update');
        $limit = $this->option('limit') ? (int) $this->option('limit') : null;

        $query = Anime::query();
        if ($limit) {
            $query->limit($limit);
        }

        $total = $query->count();
        $this->newLine();
        $this->info("📊 Total anime to process: {$total}");

        if ($total === 0) {
            $this->error('No anime found!');

            return 1;
        }

        $bar->setMaxSteps($total);
        $processed = 0;

        $query->orderBy('id')->chunk(50, function ($animes) use ($service, $update, $bar, &$processed) {
            foreach ($animes as $anime) {
                $service->importForSingleAnime($anime, $update);
                $processed++;
                $bar->advance();
                $this->output->write("\rProcessing anime #{$anime->id}: {$anime->title}");
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

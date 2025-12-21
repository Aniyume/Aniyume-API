<?php

namespace App\Console\Commands;

use App\Models\Anime;
use App\Services\EpisodeImportService;
use Illuminate\Console\Command;

class TestEpisodesImport extends Command
{
    protected $signature = 'test:import-episodes {anime_id?}';

    protected $description = 'Test episode import for debugging';

    public function handle(EpisodeImportService $service): int
    {
        $animeId = $this->argument('anime_id');

        if ($animeId) {
            $anime = Anime::find($animeId);
            if (! $anime) {
                $this->error("Anime with ID {$animeId} not found");

                return Command::FAILURE;
            }

            $this->info("Testing import for: {$anime->title}");
            $this->info('Shikimori ID: '.($anime->shikimori_id ?? 'NULL'));

            $service->importForSingleAnime($anime, false);

        } else {
            // Test first 5 anime
            $animeList = Anime::whereNotNull('shikimori_id')
                ->limit(5)
                ->get();

            foreach ($animeList as $anime) {
                $this->info("\nTesting: {$anime->title} (ID: {$anime->id}, Shikimori: {$anime->shikimori_id})");

                try {
                    $service->importForSingleAnime($anime, false);
                    $episodesCount = $anime->episodes()->count();
                    $this->info("✓ Episodes found: {$episodesCount}");
                } catch (\Exception $e) {
                    $this->error('✗ Error: '.$e->getMessage());
                }
            }
        }

        return Command::SUCCESS;
    }
}

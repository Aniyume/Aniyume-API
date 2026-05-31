<?php

namespace App\Jobs;

use App\Models\Anime;
use App\Services\EpisodeImportService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EpisodesImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $timeout = 300;

    public int $tries = 2;

    public function __construct(
        public int $animeId,
        public bool $update = false,
    ) {}

    public function handle(EpisodeImportService $importService): void
    {
        $anime = Anime::query()->find($this->animeId);

        if (! $anime) {
            Log::warning('Episodes import skipped: anime not found', [
                'anime_id' => $this->animeId,
            ]);

            return;
        }

        $importService->importForSingleAnime($anime, $this->update);
    }
}

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
        public bool $onlyMissing = true,
        public ?string $source = null,
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

        $importService->setOnlyMissing($this->onlyMissing);

        if ($this->source === 'anilibria') {
            $importService->setAvailableSources(true, false);
            $importService->setFallbackSources(false, false, false);
        } elseif ($this->source === 'kodik') {
            $importService->setAvailableSources(false, true);
            $importService->setFallbackSources(false, false, false);
        } elseif ($this->source === 'videocdn') {
            $importService->setAvailableSources(false, false);
            $importService->setFallbackSources(true, false, false);
        } elseif ($this->source === 'allanime') {
            $importService->setAvailableSources(false, false);
            $importService->setFallbackSources(false, true, false);
        } elseif ($this->source === 'external') {
            $importService->setAvailableSources(false, false);
            $importService->setFallbackSources(false, false, true);
        }

        $importService->importForSingleAnime($anime, $this->update);
    }
}

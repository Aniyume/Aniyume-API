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

    public int $animeId;

    public bool $update;

    public int $tries = 3;

    public int $timeout = 120;

    public function __construct(int $animeId, bool $update = false)
    {
        $this->animeId = $animeId;
        $this->update = $update;
    }

    public function handle(EpisodeImportService $service): void
    {
        try {
            $anime = Anime::find($this->animeId);

            if (! $anime) {
                Log::warning('Anime not found for import', ['anime_id' => $this->animeId]);

                return;
            }

            Log::info('Starting episode import', [
                'anime_id' => $anime->id,
                'title' => $anime->title,
                'update' => $this->update,
            ]);

            $service->importForSingleAnime($anime, $this->update);

            Log::info('Episode import completed', [
                'anime_id' => $anime->id,
                'title' => $anime->title,
            ]);

        } catch (\Throwable $e) {
            Log::error('Episode import failed', [
                'anime_id' => $this->animeId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            throw $e;
        }
    }

    public function failed(\Throwable $exception): void
    {
        Log::error('Episode import job failed permanently', [
            'anime_id' => $this->animeId,
            'error' => $exception->getMessage(),
        ]);
    }
}

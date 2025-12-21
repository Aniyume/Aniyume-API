<?php

namespace App\Jobs;

use App\Models\Anime;
use App\Services\EpisodeImportService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class EpisodesImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $animeId;

    public bool $update;

    public function __construct(int $animeId, bool $update = false)
    {
        $this->animeId = $animeId;
        $this->update = $update;
    }

    public function handle(EpisodeImportService $service): void
    {
        $anime = Anime::find($this->animeId);

        if (! $anime) {
            return;
        }

        $service->importForSingleAnime($anime, $this->update);
    }
}

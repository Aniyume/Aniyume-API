<?php

namespace App\Console\Commands;

use App\Services\EpisodeImportService;
use Illuminate\Console\Command;

class ImportEpisodes extends Command
{
    protected $signature = 'import:episodes {--update} {--limit=}';

    protected $description = 'Import episodes from Kodik and AniLibria';

    public function handle(): int
    {
        $service = new EpisodeImportService;

        $service->import(
            (bool) $this->option('update'),
            $this->option('limit') ? (int) $this->option('limit') : null
        );

        return self::SUCCESS;
    }
}

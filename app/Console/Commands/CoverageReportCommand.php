<?php

namespace App\Console\Commands;

use App\Models\Anime;
use App\Models\Episode;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CoverageReportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'episodes:coverage-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shows the current episode coverage for the anime catalog';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Calculating episode coverage...');

        $totalAnime = Anime::count();

        $animeWithAnilibria = Anime::whereNotNull('anilibria_id')->count();

        // Find how many unique anime have at least 1 episode
        $animeWithEpisodes = Episode::select('anime_id')->distinct('anime_id')->count();

        // Count episodes by source
        $sources = Episode::select('source', DB::raw('count(*) as count'))
            ->groupBy('source')
            ->pluck('count', 'source')
            ->toArray();

        // Calculations
        $coveragePercent = $totalAnime > 0 ? round(($animeWithEpisodes / $totalAnime) * 100, 2) : 0;
        $anilibriaMatchPercent = $totalAnime > 0 ? round(($animeWithAnilibria / $totalAnime) * 100, 2) : 0;

        $this->table(
            ['Metric', 'Value'],
            [
                ['Total Anime in Catalog', $totalAnime],
                ['Anime with Anilibria ID (Match)', "{$animeWithAnilibria} ({$anilibriaMatchPercent}%)"],
                ['Anime with AT LEAST ONE episode', "{$animeWithEpisodes} ({$coveragePercent}%)"],
            ]
        );

        $this->newLine();
        $this->info('Episodes by Source:');

        $sourceRows = [];
        $totalEpisodes = array_sum($sources);
        foreach ($sources as $source => $count) {
            $sourceName = $source ?: 'Unknown';
            $percent = $totalEpisodes > 0 ? round(($count / $totalEpisodes) * 100, 2) : 0;
            $sourceRows[] = [$sourceName, $count, "{$percent}%"];
        }

        $this->table(['Source', 'Episodes Count', '% of Total Episodes'], $sourceRows);
        $this->info("Total Episodes: {$totalEpisodes}");
    }
}

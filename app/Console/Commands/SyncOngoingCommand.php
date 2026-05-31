<?php

namespace App\Console\Commands;

use App\Models\Anime;
use App\Services\AnilibriaService;
use App\Services\EpisodeImportService;
use Illuminate\Console\Command;

class SyncOngoingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'episodes:sync-ongoing {--days=1 : Number of days back to check}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch recently updated titles from Anilibria and sync their episodes';

    /**
     * Execute the console command.
     */
    public function handle(AnilibriaService $anilibriaService, EpisodeImportService $importService)
    {
        $days = (int) $this->option('days');
        $this->info("Fetching updates from Anilibria for the last {$days} days...");

        $updates = $anilibriaService->fetchUpdates($days);

        if (empty($updates)) {
            $this->info('No updates found.');

            return;
        }

        $this->info('Found '.count($updates).' updated titles. Processing...');

        $bar = $this->output->createProgressBar(count($updates));
        $bar->start();

        foreach ($updates as $update) {
            $anilibriaId = $update['id'] ?? null;
            if (! $anilibriaId) {
                continue;
            }

            // Find anime in database
            $anime = Anime::where('anilibria_id', $anilibriaId)->first();

            // Try to match by shikimori_id if anilibria_id is missing but we have it from update
            if (! $anime && ! empty($update['player']['shikimori_id'])) {
                $anime = Anime::where('shikimori_id', $update['player']['shikimori_id'])->first();
                if ($anime) {
                    $anime->update(['anilibria_id' => $anilibriaId]);
                }
            }

            if ($anime) {
                // Rerun full import for this anime to update episodes
                $importService->importForSingleAnime($anime, true);
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        $this->info('Sync completed!');
        $this->table(
            ['Metric', 'Value'],
            [
                ['Processed', $importService->processed],
                ['Created', $importService->created],
                ['Updated', $importService->updated],
                ['Errors', $importService->errors],
            ]
        );
    }
}

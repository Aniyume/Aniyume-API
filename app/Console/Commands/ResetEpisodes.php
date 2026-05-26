<?php

namespace App\Console\Commands;

use App\Models\Anime;
use App\Models\Episode;
use Illuminate\Console\Command;

class ResetEpisodes extends Command
{
    protected $signature = 'episodes:reset
        {--source= : Reset only episodes from a specific source (anilibria, kodik, videocdn). Omit for all.}
        {--force : Skip confirmation prompt}';

    protected $description = 'Reset (delete) all imported episodes from the database';

    public function handle(): int
    {
        $source = $this->option('source');

        // Show current stats
        $totalEpisodes = Episode::count();
        $bySource = Episode::selectRaw('COALESCE(source, \'unknown\') as source, COUNT(*) as count')
            ->groupBy('source')
            ->pluck('count', 'source')
            ->toArray();

        $this->newLine();
        $this->info('📊 Current episode statistics:');
        $this->table(['Source', 'Count'], collect($bySource)->map(fn($c, $s) => [$s, $c])->values()->toArray());
        $this->info("Total: {$totalEpisodes} episodes");
        $this->newLine();

        if ($totalEpisodes === 0) {
            $this->warn('⚠️  No episodes found in the database. Nothing to reset.');
            return 0;
        }

        // Determine what we're deleting
        $query = Episode::query();
        $label = 'ALL episodes';

        if ($source) {
            $query->where('source', $source);
            $count = $query->count();
            $label = "{$count} episodes from source '{$source}'";

            if ($count === 0) {
                $this->warn("⚠️  No episodes found with source '{$source}'.");
                return 0;
            }
        }

        // Confirmation
        if (!$this->option('force')) {
            if (!$this->confirm("🗑️  Are you sure you want to delete {$label}?", false)) {
                $this->info('❌ Operation cancelled.');
                return 0;
            }
        }

        // Perform deletion
        $this->info('🔄 Deleting episodes...');

        if ($source) {
            $deleted = Episode::where('source', $source)->delete();
        } else {
            $deleted = Episode::truncate();
            $deleted = $totalEpisodes; // truncate returns void
        }

        $this->info("✅ Deleted {$deleted} episodes.");

        // Reset anilibria_id on anime if clearing anilibria or all sources
        if (!$source || $source === 'anilibria') {
            $resetCount = Anime::whereNotNull('anilibria_id')->update(['anilibria_id' => null]);
            $this->info("🔄 Reset anilibria_id on {$resetCount} anime records.");
        }

        // Show remaining stats
        $remaining = Episode::count();
        $this->newLine();
        $this->info("📊 Remaining episodes: {$remaining}");

        return 0;
    }
}

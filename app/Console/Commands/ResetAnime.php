<?php

namespace App\Console\Commands;

use App\Models\Anime;
use App\Models\Episode;
use App\Models\Tag;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class ResetAnime extends Command
{
    protected $signature = 'anime:reset
        {--keep-users : Keep user data (favorites, ratings, watch history, anime lists)}
        {--force : Skip confirmation prompt}';

    protected $description = 'Reset (delete) all anime, episodes, tags, and related data from the database';

    public function handle(): int
    {
        // Show current stats
        $animeCount = Anime::count();
        $episodeCount = Episode::count();
        $tagCount = Tag::count();

        $this->newLine();
        $this->info('📊 Current database statistics:');
        $this->table(
            ['Table', 'Records'],
            [
                ['anime', $animeCount],
                ['episodes', $episodeCount],
                ['tags', $tagCount],
            ]
        );

        if ($animeCount === 0) {
            $this->warn('⚠️  No anime found in the database. Nothing to reset.');
            return 0;
        }

        $keepUsers = $this->option('keep-users');

        $label = $keepUsers
            ? "ALL anime ({$animeCount}), episodes ({$episodeCount}), tags ({$tagCount}). User data will be KEPT."
            : "ALL anime ({$animeCount}), episodes ({$episodeCount}), tags ({$tagCount}), AND all user-related data (favorites, ratings, comments, watch history, anime lists).";

        // Confirmation
        if (!$this->option('force')) {
            $this->warn("🗑️  This will delete: {$label}");
            if (!$this->confirm('Are you sure?', false)) {
                $this->info('❌ Operation cancelled.');
                return 0;
            }
        }

        $this->info('🔄 Resetting database...');

        // Disable foreign key checks temporarily for clean truncation
        \DB::statement('SET session_replication_role = \'replica\';');

        try {
            // 1. Delete episodes
            $this->line("  Deleting episodes...");
            Episode::truncate();

            // 2. Delete pivot tables
            $this->line("  Deleting anime-tag relations...");
            \DB::table('anime_tag')->truncate();

            if (!$keepUsers) {
                $this->line("  Deleting user anime data...");

                // Delete user-related anime data
                if (Schema::hasTable('anime_user')) {
                    \DB::table('anime_user')->truncate();
                }
                if (Schema::hasTable('favorites')) {
                    \DB::table('favorites')->truncate();
                }
                if (Schema::hasTable('ratings')) {
                    \DB::table('ratings')->truncate();
                }
                if (Schema::hasTable('comments')) {
                    \DB::table('comments')->truncate();
                }
                if (Schema::hasTable('watch_history')) {
                    \DB::table('watch_history')->truncate();
                }
            }

            // 3. Delete anime
            $this->line("  Deleting anime...");
            Anime::truncate();

            // 4. Delete tags
            $this->line("  Deleting tags...");
            Tag::truncate();

            // 5. Clear import logs
            if (Schema::hasTable('import_logs')) {
                $this->line("  Clearing import logs...");
                \DB::table('import_logs')->truncate();
            }

        } finally {
            \DB::statement('SET session_replication_role = \'origin\';');
        }

        $this->newLine();
        $this->info('✅ Database reset complete!');
        $this->table(
            ['Table', 'Records'],
            [
                ['anime', Anime::count()],
                ['episodes', Episode::count()],
                ['tags', Tag::count()],
            ]
        );

        $this->newLine();
        $this->info('📝 Next steps:');
        $this->line('  1. Import anime:    php artisan import:anime --initial');
        $this->line('  2. Import episodes: php artisan import:episodes --limit=100');

        return 0;
    }
}

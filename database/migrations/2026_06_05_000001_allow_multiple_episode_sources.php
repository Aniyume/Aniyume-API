<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'pgsql') {
            DB::statement('ALTER TABLE episodes DROP CONSTRAINT IF EXISTS episodes_anime_id_episode_number_unique');

            return;
        }

        if ($driver === 'mysql') {
            try {
                DB::statement('ALTER TABLE episodes DROP INDEX episodes_anime_id_episode_number_unique');
            } catch (\Throwable) {
                // Index already absent.
            }

            return;
        }

        if ($driver === 'sqlite') {
            // SQLite cannot drop a unique index/constraint reliably without table rebuild.
            // Fresh databases can rely on later source-aware matching; existing SQLite dev DBs
            // may need a manual rebuild if the original unique constraint is still present.
            return;
        }
    }

    public function down(): void
    {
        // Do not restore the legacy unique constraint: the app intentionally supports
        // multiple sources/translators for the same anime episode.
    }
};

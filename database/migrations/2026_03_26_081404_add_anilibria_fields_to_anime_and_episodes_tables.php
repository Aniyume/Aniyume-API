<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('anime', function (Blueprint $table) {
            if (! Schema::hasColumn('anime', 'anilibria_id')) {
                $table->string('anilibria_id', 64)->nullable()->after('shikimori_id')->index();
            }
        });

        Schema::table('episodes', function (Blueprint $table) {
            if (! Schema::hasColumn('episodes', 'skip_times')) {
                $table->json('skip_times')->nullable();
            }
            if (! Schema::hasColumn('episodes', 'player_iframe')) {
                $table->text('player_iframe')->nullable();
            }
            if (! Schema::hasColumn('episodes', 'season_number')) {
                $table->integer('season_number')->nullable();
            }
            if (! Schema::hasColumn('episodes', 'translator')) {
                $table->string('translator')->nullable();
            }
            if (! Schema::hasColumn('episodes', 'translation_type')) {
                $table->string('translation_type')->nullable();
            }
            if (! Schema::hasColumn('episodes', 'quality')) {
                $table->string('quality')->nullable();
            }
            if (! Schema::hasColumn('episodes', 'source')) {
                $table->string('source')->nullable();
            }
            if (! Schema::hasColumn('episodes', 'priority')) {
                $table->integer('priority')->default(0);
            }
            if (! Schema::hasColumn('episodes', 'external_episode_id')) {
                $table->string('external_episode_id')->nullable();
            }
            if (! Schema::hasColumn('episodes', 'poster_url')) {
                $table->string('poster_url', 1024)->nullable();
            }
            if (! Schema::hasColumn('episodes', 'translation_name')) {
                $table->string('translation_name')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('anime', function (Blueprint $table) {
            if (Schema::hasColumn('anime', 'anilibria_id')) {
                $table->dropColumn('anilibria_id');
            }
        });

        Schema::table('episodes', function (Blueprint $table) {
            $columnsToDrop = [];
            $columns = [
                'skip_times', 'player_iframe', 'season_number', 'translator',
                'translation_type', 'quality', 'source', 'priority', 'external_episode_id',
                'poster_url', 'translation_name',
            ];
            foreach ($columns as $column) {
                if (Schema::hasColumn('episodes', $column)) {
                    $columnsToDrop[] = $column;
                }
            }
            if (! empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};

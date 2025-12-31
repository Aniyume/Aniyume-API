<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('anime_user', function (Blueprint $table) {
            if (!Schema::hasColumn('anime_user', 'episodes_watched')) {
                $table->unsignedInteger('episodes_watched')->default(0);
            }

            if (!Schema::hasColumn('anime_user', 'last_watched_at')) {
                $table->timestamp('last_watched_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('anime_user', function (Blueprint $table) {
            if (Schema::hasColumn('anime_user', 'episodes_watched')) {
                $table->dropColumn('episodes_watched');
            }

            if (Schema::hasColumn('anime_user', 'last_watched_at')) {
                $table->dropColumn('last_watched_at');
            }
        });
    }
};

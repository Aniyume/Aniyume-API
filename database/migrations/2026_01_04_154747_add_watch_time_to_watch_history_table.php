<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('watch_history', function (Blueprint $table) {
            $table->unsignedInteger('watch_time')->default(0)->after('progress');
            $table->dropIndex(['user_id', 'episode_id']);
            $table->unique(['user_id', 'episode_id']);
        });
    }

    public function down(): void
    {
        Schema::table('watch_history', function (Blueprint $table) {
            $table->dropUnique(['user_id', 'episode_id']);
            $table->index(['user_id', 'episode_id']);
            $table->dropColumn('watch_time');
        });
    }
};

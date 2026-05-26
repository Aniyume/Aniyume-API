<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('watch_history')) {
            return;
        }

        Schema::table('watch_history', function (Blueprint $table) {
            if (!Schema::hasColumn('watch_history', 'watch_time')) {
                $table->unsignedInteger('watch_time')->default(0)->after('progress');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('watch_history')) {
            return;
        }

        Schema::table('watch_history', function (Blueprint $table) {
            if (Schema::hasColumn('watch_history', 'watch_time')) {
                $table->dropColumn('watch_time');
            }
        });
    }
};

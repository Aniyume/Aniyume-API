<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('import_logs', function (Blueprint $table) {
            $table->unsignedInteger('anime_created')->default(0)->after('total_skipped');
            $table->unsignedInteger('episodes_created')->default(0)->after('anime_created');
            $table->unsignedInteger('banners_updated')->default(0)->after('episodes_created');
        });
    }

    public function down(): void
    {
        Schema::table('import_logs', function (Blueprint $table) {
            $table->dropColumn(['anime_created', 'episodes_created', 'banners_updated']);
        });
    }
};

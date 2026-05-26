<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('anime', function (Blueprint $table) {
            if (!Schema::hasColumn('anime', 'title_en')) {
                $table->string('title_en')->nullable()->after('title');
            }
            if (!Schema::hasColumn('anime', 'title_jp')) {
                $table->string('title_jp')->nullable()->after('title_en');
            }
            if (!Schema::hasColumn('anime', 'cover_url')) {
                $table->string('cover_url', 1024)->nullable()->after('poster_url');
            }
            if (!Schema::hasColumn('anime', 'duration')) {
                $table->integer('duration')->nullable()->after('number_of_episodes');
            }
            if (!Schema::hasColumn('anime', 'views_count')) {
                $table->integer('views_count')->default(0)->after('popularity');
            }
            if (!Schema::hasColumn('anime', 'favorites_count')) {
                $table->integer('favorites_count')->default(0)->after('views_count');
            }
        });
    }

    public function down(): void
    {
        Schema::table('anime', function (Blueprint $table) {
            $columns = ['title_en', 'title_jp', 'cover_url', 'duration', 'views_count', 'favorites_count'];
            $toDrop = [];
            foreach ($columns as $col) {
                if (Schema::hasColumn('anime', $col)) {
                    $toDrop[] = $col;
                }
            }
            if (!empty($toDrop)) {
                $table->dropColumn($toDrop);
            }
        });
    }
};

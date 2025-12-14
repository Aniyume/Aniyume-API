<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('anime', function (Blueprint $table) {
            $table->integer('viewed_count')->default(0)->after('favorites');
            $table->integer('comments_count')->default(0)->after('viewed_count');
            $table->integer('ratings_count')->default(0)->after('comments_count');
            $table->decimal('rating_sum', 10, 2)->default(0)->after('ratings_count');
        });
    }

    public function down(): void
    {
        Schema::table('anime', function (Blueprint $table) {
            $table->dropColumn(['viewed_count', 'comments_count', 'ratings_count', 'rating_sum']);
        });
    }
};

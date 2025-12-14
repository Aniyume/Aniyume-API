<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('watch_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('anime_id')->constrained('anime')->onDelete('cascade');
            $table->foreignId('episode_id')->nullable()->constrained('episodes')->onDelete('cascade');
            $table->integer('progress')->default(0)->comment('Progress in seconds');
            $table->boolean('completed')->default(false);
            $table->timestamp('watched_at')->useCurrent();
            $table->timestamps();

            $table->index(['user_id', 'anime_id']);
            $table->index(['user_id', 'episode_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('watch_history');
    }
};

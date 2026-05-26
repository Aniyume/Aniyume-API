<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('watch_party_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('code', 8)->unique();
            $table->foreignId('anime_id')->constrained('anime')->onDelete('cascade');
            $table->integer('episode_number')->default(1);
            $table->foreignId('host_user_id')->constrained('users')->onDelete('cascade');
            $table->boolean('is_active')->default(true);
            $table->integer('max_participants')->default(10);
            $table->boolean('is_private')->default(false);
            $table->string('password', 8)->nullable();
            // Current player state
            $table->decimal('current_time', 10, 2)->default(0);
            $table->boolean('is_playing')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('watch_party_rooms');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('anime_user')) {
            return;
        }

        Schema::create('anime_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('anime_id')->constrained('anime')->onDelete('cascade');
            $table->string('status', 32)->default('watching');
            $table->timestamps();

            $table->primary(['user_id', 'anime_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anime_user');
    }
};

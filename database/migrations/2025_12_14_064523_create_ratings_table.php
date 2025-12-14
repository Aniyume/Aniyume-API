<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('anime_id')->constrained('anime')->onDelete('cascade');
            $table->decimal('rating', 3, 1)->comment('Rating from 1.0 to 10.0');
            $table->timestamps();

            $table->unique(['user_id', 'anime_id']);
            $table->index('anime_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};

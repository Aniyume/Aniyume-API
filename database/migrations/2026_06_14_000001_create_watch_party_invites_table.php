<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('watch_party_invites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained('watch_party_rooms')->onDelete('cascade');
            $table->foreignId('from_user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('to_user_id')->constrained('users')->onDelete('cascade');
            $table->string('status')->default('pending'); // pending | accepted | declined
            $table->timestamps();

            $table->index(['to_user_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('watch_party_invites');
    }
};

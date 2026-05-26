<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('watch_party_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained('watch_party_rooms')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('message');
            $table->string('type')->default('message'); // message | system
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('watch_party_messages');
    }
};

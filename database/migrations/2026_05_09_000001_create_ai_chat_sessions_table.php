<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_chat_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('session_id', 120)->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('role_snapshot', 40)->nullable();
            $table->string('tier_snapshot', 40)->nullable();
            $table->timestamp('last_message_at')->nullable();
            $table->timestamp('expires_at')->nullable()->comment('Retention foundation: future cleanup may remove expired AI chat sessions and messages.');
            $table->timestamps();

            $table->index(['user_id', 'last_message_at']);
            $table->index('expires_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_chat_sessions');
    }
};

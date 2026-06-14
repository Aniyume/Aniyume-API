<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('privacy_favorites')->default('friends');
            $table->string('privacy_watch_history')->default('friends');
            $table->string('privacy_ratings')->default('friends');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['privacy_favorites', 'privacy_watch_history', 'privacy_ratings']);
        });
    }
};

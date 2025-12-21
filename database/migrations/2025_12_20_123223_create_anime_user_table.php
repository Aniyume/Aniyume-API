<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('anime_user', function (Blueprint $table) {
            $table->integer('episodes_watched')->default(0)->after('status');
            $table->timestamp('last_watched_at')->nullable()->after('episodes_watched');
            $table->index(['user_id', 'status']);
            $table->index(['user_id', 'last_watched_at']);
        });

        Schema::create('friendships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('friend_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();

            $table->unique(['user_id', 'friend_id']);
            $table->index('status');
        });

        Schema::create('user_videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('video_url');
            $table->string('thumbnail_url')->nullable();
            $table->integer('views_count')->default(0);
            $table->timestamps();

            $table->index('user_id');
        });

        Schema::create('user_collections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_public')->default(true);
            $table->timestamps();

            $table->index(['user_id', 'is_public']);
        });

        Schema::create('collection_anime', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collection_id')->constrained('user_collections')->onDelete('cascade');
            $table->foreignId('anime_id')->constrained()->onDelete('cascade');
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->unique(['collection_id', 'anime_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('collection_anime');
        Schema::dropIfExists('user_collections');
        Schema::dropIfExists('user_videos');
        Schema::dropIfExists('friendships');

        Schema::table('anime_user', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'status']);
            $table->dropIndex(['user_id', 'last_watched_at']);
            $table->dropColumn(['episodes_watched', 'last_watched_at']);
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('anime', function (Blueprint $table) {
            $table->index(['status', 'year', 'popularity', 'rating'], 'anime_public_listing_idx');
            $table->index(['type', 'year'], 'anime_type_year_idx');
            $table->index('aired_from', 'anime_aired_from_idx');
            $table->index('year', 'anime_year_idx');
            $table->index('popularity', 'anime_popularity_idx');
            $table->index('rating', 'anime_rating_idx');
        });

        Schema::table('episodes', function (Blueprint $table) {
            $table->index(['anime_id', 'episode_number', 'priority'], 'episodes_sources_lookup_idx');
            $table->index(['anime_id', 'episode_number'], 'episodes_anime_episode_idx');
            $table->index(['translator', 'translation_type'], 'episodes_translators_idx');
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->index('name', 'tags_name_idx');
        });

        Schema::table('anime_tag', function (Blueprint $table) {
            $table->index(['tag_id', 'anime_id'], 'anime_tag_tag_anime_idx');
        });

        Schema::table('anime_user', function (Blueprint $table) {
            $table->index(['anime_id', 'status'], 'anime_user_anime_status_idx');
            $table->index(['user_id', 'status'], 'anime_user_user_status_idx');
            $table->index(['user_id', 'last_watched_at'], 'anime_user_user_last_watched_idx');
        });

        Schema::table('watch_history', function (Blueprint $table) {
            $table->index(['user_id', 'watched_at'], 'watch_history_user_watched_idx');
            $table->index(['user_id', 'anime_id', 'watched_at'], 'watch_history_user_anime_watched_idx');
            $table->index(['user_id', 'episode_id', 'watched_at'], 'watch_history_user_episode_watched_idx');
        });
    }

    public function down(): void
    {
        Schema::table('watch_history', function (Blueprint $table) {
            $table->dropIndex('watch_history_user_episode_watched_idx');
            $table->dropIndex('watch_history_user_anime_watched_idx');
            $table->dropIndex('watch_history_user_watched_idx');
        });

        Schema::table('anime_user', function (Blueprint $table) {
            $table->dropIndex('anime_user_user_last_watched_idx');
            $table->dropIndex('anime_user_user_status_idx');
            $table->dropIndex('anime_user_anime_status_idx');
        });

        Schema::table('anime_tag', function (Blueprint $table) {
            $table->dropIndex('anime_tag_tag_anime_idx');
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->dropIndex('tags_name_idx');
        });

        Schema::table('episodes', function (Blueprint $table) {
            $table->dropIndex('episodes_translators_idx');
            $table->dropIndex('episodes_anime_episode_idx');
            $table->dropIndex('episodes_sources_lookup_idx');
        });

        Schema::table('anime', function (Blueprint $table) {
            $table->dropIndex('anime_rating_idx');
            $table->dropIndex('anime_popularity_idx');
            $table->dropIndex('anime_year_idx');
            $table->dropIndex('anime_aired_from_idx');
            $table->dropIndex('anime_type_year_idx');
            $table->dropIndex('anime_public_listing_idx');
        });
    }
};

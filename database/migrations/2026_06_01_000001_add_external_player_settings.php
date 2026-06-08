<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $now = now();
        $settings = [
            ['key' => 'external_players.enabled', 'value' => 'false', 'type' => 'boolean', 'group' => 'players', 'is_public' => false, 'description' => 'Enable configured external iframe players as last-resort episode fallback'],
            ['key' => 'external_players.providers', 'value' => json_encode([
                ['key' => 'alloha', 'name' => 'Alloha', 'enabled' => false, 'template' => '', 'translator' => 'Alloha'],
                ['key' => 'collaps', 'name' => 'Collaps', 'enabled' => false, 'template' => '', 'translator' => 'Collaps'],
                ['key' => 'ashdi', 'name' => 'Ashdi', 'enabled' => false, 'template' => '', 'translator' => 'Ashdi'],
                ['key' => 'vibix', 'name' => 'Vibix', 'enabled' => false, 'template' => '', 'translator' => 'Vibix'],
                ['key' => 'hdvb', 'name' => 'HDVB', 'enabled' => false, 'template' => '', 'translator' => 'HDVB'],
            ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), 'type' => 'json', 'group' => 'players', 'is_public' => false, 'description' => 'External player templates. Supported vars: {shikimori_id}, {title}, {title_en}, {year}, {anime_id}'],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->updateOrInsert(
                ['key' => $setting['key']],
                array_merge($setting, ['created_at' => $now, 'updated_at' => $now])
            );
        }
    }

    public function down(): void
    {
        DB::table('settings')->whereIn('key', ['external_players.enabled', 'external_players.providers'])->delete();
    }
};

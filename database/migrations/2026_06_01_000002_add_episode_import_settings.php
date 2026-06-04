<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $now = now();
        $settings = [
            ['key' => 'episodes.import_all_translations', 'value' => 'true', 'type' => 'boolean', 'group' => 'episodes', 'is_public' => false, 'description' => 'Import multiple Kodik translations/voiceovers for the same anime instead of only the first match'],
            ['key' => 'episodes.max_kodik_translations', 'value' => '25', 'type' => 'integer', 'group' => 'episodes', 'is_public' => false, 'description' => 'Maximum Kodik translations to import per anime. Use 0 for unlimited'],
            ['key' => 'episodes.include_kodik_subtitles', 'value' => 'true', 'type' => 'boolean', 'group' => 'episodes', 'is_public' => false, 'description' => 'Import Kodik subtitle translations in addition to voice translations'],
            ['key' => 'episodes.preferred_translators', 'value' => json_encode(['AniLibria', 'AniDUB', 'SHIZA Project', 'StudioBand', 'AniStar', 'Kodik'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), 'type' => 'json', 'group' => 'episodes', 'is_public' => false, 'description' => 'Preferred translator names used for ordering imported sources'],
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
        DB::table('settings')->whereIn('key', [
            'episodes.import_all_translations',
            'episodes.max_kodik_translations',
            'episodes.include_kodik_subtitles',
            'episodes.preferred_translators',
        ])->delete();
    }
};

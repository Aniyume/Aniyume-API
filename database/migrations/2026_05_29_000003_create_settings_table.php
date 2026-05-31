<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type', 32)->default('string');
            $table->string('group', 80)->default('general');
            $table->boolean('is_public')->default(false);
            $table->boolean('is_encrypted')->default(false);
            $table->string('description')->nullable();
            $table->timestamps();
            $table->index(['group', 'key']);
        });

        $now = now();
        DB::table('settings')->insert([
            ['key' => 'site.name', 'value' => 'AniYume', 'type' => 'string', 'group' => 'general', 'is_public' => true, 'description' => 'Public service name', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'site.support_email', 'value' => 'support@aniyume.com', 'type' => 'string', 'group' => 'general', 'is_public' => true, 'description' => 'Support email shown to users', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'site.maintenance_mode', 'value' => 'false', 'type' => 'boolean', 'group' => 'general', 'is_public' => false, 'description' => 'Soft maintenance flag for UI', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'features.registration', 'value' => 'true', 'type' => 'boolean', 'group' => 'features', 'is_public' => false, 'description' => 'Allow new registrations', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'features.comments', 'value' => 'true', 'type' => 'boolean', 'group' => 'features', 'is_public' => false, 'description' => 'Enable comments', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'features.reports', 'value' => 'true', 'type' => 'boolean', 'group' => 'features', 'is_public' => false, 'description' => 'Enable public reports', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'features.contacts', 'value' => 'true', 'type' => 'boolean', 'group' => 'features', 'is_public' => false, 'description' => 'Enable contact feedback page', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'features.ai_chat', 'value' => 'true', 'type' => 'boolean', 'group' => 'features', 'is_public' => false, 'description' => 'Enable AI chat', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'features.watch_party', 'value' => 'true', 'type' => 'boolean', 'group' => 'features', 'is_public' => false, 'description' => 'Enable watch party', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'moderation.profanity_mode', 'value' => 'medium', 'type' => 'string', 'group' => 'moderation', 'is_public' => false, 'description' => 'off/soft/medium/strict', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'moderation.max_comment_length', 'value' => '1000', 'type' => 'integer', 'group' => 'moderation', 'is_public' => false, 'description' => 'Max comment length', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'moderation.report_duplicate_cooldown_minutes', 'value' => '30', 'type' => 'integer', 'group' => 'moderation', 'is_public' => false, 'description' => 'Duplicate report cooldown', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'uploads.max_poster_size_mb', 'value' => '5', 'type' => 'integer', 'group' => 'uploads', 'is_public' => false, 'description' => 'Max poster upload size', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'uploads.allowed_image_types', 'value' => 'jpg,jpeg,png,webp', 'type' => 'string', 'group' => 'uploads', 'is_public' => false, 'description' => 'Allowed image mimes/extensions', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'imports.enabled', 'value' => 'true', 'type' => 'boolean', 'group' => 'imports', 'is_public' => false, 'description' => 'Enable imports', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'imports.default_source', 'value' => 'anilibria', 'type' => 'string', 'group' => 'imports', 'is_public' => false, 'description' => 'Default import source', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};

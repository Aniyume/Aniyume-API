<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->foreignId('parent_id')->nullable()->after('id')->constrained('comments')->cascadeOnDelete();
            $table->timestamp('admin_hearted_at')->nullable()->after('is_approved');
            $table->foreignId('admin_hearted_by')->nullable()->after('admin_hearted_at')->constrained('users')->nullOnDelete();
            $table->index(['parent_id', 'created_at']);
        });

        Schema::create('comment_reactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comment_id')->constrained('comments')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('type', 16);
            $table->timestamps();
            $table->unique(['comment_id', 'user_id']);
            $table->index(['comment_id', 'type']);
        });

        Schema::table('contact_messages', function (Blueprint $table) {
            $table->binary('photo')->nullable()->after('message');
            $table->string('photo_mime')->nullable()->after('photo');
            $table->string('photo_name')->nullable()->after('photo_mime');
            $table->unsignedInteger('photo_size')->nullable()->after('photo_name');
        });
    }

    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropColumn(['photo', 'photo_mime', 'photo_name', 'photo_size']);
        });

        Schema::dropIfExists('comment_reactions');

        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropForeign(['admin_hearted_by']);
            $table->dropIndex(['parent_id', 'created_at']);
            $table->dropColumn(['parent_id', 'admin_hearted_at', 'admin_hearted_by']);
        });
    }
};

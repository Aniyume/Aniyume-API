<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('audit_logs', function (Blueprint $table) {
            $table->string('entity_type')->nullable()->after('description');
            $table->unsignedBigInteger('entity_id')->nullable()->after('entity_type');
            $table->json('before')->nullable()->after('entity_id');
            $table->json('after')->nullable()->after('before');
            $table->json('metadata')->nullable()->after('after');
            $table->index(['entity_type', 'entity_id']);
            $table->index(['action', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::table('audit_logs', function (Blueprint $table) {
            $table->dropIndex(['entity_type', 'entity_id']);
            $table->dropIndex(['action', 'created_at']);
            $table->dropColumn(['entity_type', 'entity_id', 'before', 'after', 'metadata']);
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('users')) {
            return;
        }

        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'ban_expires_at')) {
                $table->timestamp('ban_expires_at')->nullable()->after('ban_reason')->index();
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('users') || ! Schema::hasColumn('users', 'ban_expires_at')) {
            return;
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('ban_expires_at');
        });
    }
};

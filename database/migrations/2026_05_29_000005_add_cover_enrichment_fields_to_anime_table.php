<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('anime', function (Blueprint $table) {
            if (! Schema::hasColumn('anime', 'cover_source')) {
                $table->string('cover_source', 80)->nullable()->after('cover_url');
            }
            if (! Schema::hasColumn('anime', 'cover_locked')) {
                $table->boolean('cover_locked')->default(false)->after('cover_source');
            }
            if (! Schema::hasColumn('anime', 'cover_updated_at')) {
                $table->timestamp('cover_updated_at')->nullable()->after('cover_locked');
            }
        });
    }

    public function down(): void
    {
        Schema::table('anime', function (Blueprint $table) {
            $columns = [];
            foreach (['cover_source', 'cover_locked', 'cover_updated_at'] as $column) {
                if (Schema::hasColumn('anime', $column)) {
                    $columns[] = $column;
                }
            }
            if ($columns) {
                $table->dropColumn($columns);
            }
        });
    }
};

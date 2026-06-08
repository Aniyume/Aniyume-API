<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('anime', function (Blueprint $table) {
            if (! Schema::hasColumn('anime', 'shikimori_id')) {
                $table->unsignedBigInteger('shikimori_id')->nullable()->after('external_source')->index();
            }
        });

        if (Schema::hasColumn('anime', 'external_id') && Schema::hasColumn('anime', 'external_source')) {
            $driver = DB::connection()->getDriverName();

            DB::table('anime')
                ->whereNull('shikimori_id')
                ->whereNotNull('external_id')
                ->where('external_source', 'shikimori')
                ->when($driver === 'pgsql', fn ($query) => $query->whereRaw("external_id ~ '^[0-9]+$'"))
                ->when($driver === 'sqlite', fn ($query) => $query->whereRaw("external_id GLOB '[0-9]*'"))
                ->update(['shikimori_id' => DB::raw($driver === 'pgsql' ? 'CAST(external_id AS BIGINT)' : 'CAST(external_id AS INTEGER)')]);
        }
    }

    public function down(): void
    {
        Schema::table('anime', function (Blueprint $table) {
            if (Schema::hasColumn('anime', 'shikimori_id')) {
                $table->dropColumn('shikimori_id');
            }
        });
    }
};

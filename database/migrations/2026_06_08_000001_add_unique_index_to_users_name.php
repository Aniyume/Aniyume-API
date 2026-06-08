<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Перед включением unique-индекса разводим существующие дубликаты имён:
        // самый ранний аккаунт сохраняет имя, остальным добавляется суффикс _id.
        $duplicateNames = DB::table('users')
            ->select('name')
            ->groupBy('name')
            ->havingRaw('COUNT(*) > 1')
            ->pluck('name');

        foreach ($duplicateNames as $name) {
            $rows = DB::table('users')
                ->where('name', $name)
                ->orderBy('id')
                ->get(['id']);

            foreach ($rows as $index => $row) {
                if ($index === 0) {
                    continue; // первый оставляем как есть
                }

                $newName = $name.'_'.$row->id;
                while (DB::table('users')->where('name', $newName)->exists()) {
                    $newName .= '_x';
                }

                DB::table('users')->where('id', $row->id)->update(['name' => $newName]);
            }
        }

        Schema::table('users', function (Blueprint $table) {
            $table->unique('name');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['name']);
        });
    }
};

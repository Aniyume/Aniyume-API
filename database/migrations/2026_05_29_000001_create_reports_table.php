<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reporter_id')->nullable()->constrained('users')->nullOnDelete();
            $table->morphs('target');
            $table->string('category', 80)->default('other');
            $table->string('reason', 255);
            $table->text('details')->nullable();
            $table->string('status', 40)->default('pending');
            $table->foreignId('admin_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('resolution_note')->nullable();
            $table->timestampTz('resolved_at')->nullable();
            $table->timestampsTz();

            $table->index(['status', 'created_at']);
            $table->index(['category', 'created_at']);
            $table->index(['admin_id', 'resolved_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'import_type',
        'started_at',
        'finished_at',
        'total_processed',
        'total_created',
        'total_updated',
        'total_skipped',
        'anime_created',
        'episodes_created',
        'banners_updated',
        'errors',
        'status',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];
}

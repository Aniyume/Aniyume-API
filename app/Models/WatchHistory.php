<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WatchHistory extends Model
{
    use HasFactory;

    protected $table = 'watch_history';

    protected $fillable = [
        'user_id',
        'anime_id',
        'episode_id',
        'progress',
        'watch_time',
        'completed',
        'watched_at',
    ];

    protected $casts = [
        'completed' => 'boolean',
        'watched_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function anime()
    {
        return $this->belongsTo(Anime::class);
    }

    public function episode()
    {
        return $this->belongsTo(Episode::class);
    }
}

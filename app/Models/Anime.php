<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Anime extends Model
{
    protected $table = 'anime';

    protected $fillable = [
        'external_id',
        'shikimori_id',
        'title',
        'slug',
        'title_en',
        'title_jp',
        'description',
        'poster_url',
        'cover_url',
        'type',
        'status',
        'episodes_count',
        'duration',
        'release_year',
        'aired_from',
        'aired_to',
        'rating',
        'popularity',
        'views_count',
        'favorites_count',
    ];

    protected $casts = [
        'episodes_count' => 'integer',
        'duration' => 'integer',
        'release_year' => 'integer',
        'rating' => 'decimal:2',
        'popularity' => 'integer',
        'views_count' => 'integer',
        'favorites_count' => 'integer',
        'aired_from' => 'datetime',
        'aired_to' => 'datetime',
    ];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'anime_tag');
    }

    public function episodes(): HasMany
    {
        return $this->hasMany(Episode::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'anime_user')
            ->withPivot(['status', 'episodes_watched', 'last_watched_at'])
            ->withTimestamps();
    }

    public function getCommunityStats()
    {
        $stats = $this->users()
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        return [
            'watching' => $stats->get('watching', 0),
            'planned' => $stats->get('planned', 0),
            'completed' => $stats->get('completed', 0),
            'on_hold' => $stats->get('on_hold', 0),
            'dropped' => $stats->get('dropped', 0),
            'total' => $stats->sum(),
        ];
    }
}

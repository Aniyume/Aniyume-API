<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory;

    protected $table = 'anime';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'poster_url',
        'rating',
        'year',
        'status',
        'type',
        'number_of_episodes',
        'external_id',
        'external_source',
        'aired_from',
        'aired_to',
        'nsfw_flag',
        'popularity',
        'favorites',
    ];

    protected $casts = [
        'aired_from' => 'date',
        'aired_to' => 'date',
        'nsfw_flag' => 'boolean',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'anime_genre');
    }

    public function studios()
    {
        return $this->belongsToMany(Studio::class, 'anime_studio');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'anime_tag');
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }
    public function watchHistory()
{
    return $this->hasMany(WatchHistory::class);
}

public function favorites()
{
    return $this->hasMany(Favorite::class);
}

public function ratings()
{
    return $this->hasMany(Rating::class);
}

public function comments()
{
    return $this->hasMany(Comment::class);
}

}

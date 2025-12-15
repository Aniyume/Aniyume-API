<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = ['name', 'slug'];

    public function anime()
    {
        return $this->belongsToMany(Anime::class, 'anime_genre', 'genre_id', 'anime_id');
    }
}

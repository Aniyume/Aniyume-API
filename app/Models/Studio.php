<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    protected $fillable = ['name', 'slug'];

    public function anime()
    {
        return $this->belongsToMany(Anime::class, 'anime_studio', 'studio_id', 'anime_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlacklistedAnime extends Model
{
    protected $table = 'blacklisted_anime';
    protected $fillable = ['external_id', 'external_source'];
}

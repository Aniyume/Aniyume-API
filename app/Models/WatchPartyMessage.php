<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WatchPartyMessage extends Model
{
    protected $fillable = [
        'room_id',
        'user_id',
        'message',
        'type',
    ];

    protected $casts = [
        'type' => 'string',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(WatchPartyRoom::class, 'room_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

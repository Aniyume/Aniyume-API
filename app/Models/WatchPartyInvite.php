<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WatchPartyInvite extends Model
{
    protected $fillable = [
        'room_id',
        'from_user_id',
        'to_user_id',
        'status',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(WatchPartyRoom::class, 'room_id');
    }

    public function fromUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function toUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }
}

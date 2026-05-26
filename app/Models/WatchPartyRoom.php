<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WatchPartyRoom extends Model
{
    protected $fillable = [
        'code',
        'anime_id',
        'episode_number',
        'host_user_id',
        'is_active',
        'max_participants',
        'is_private',
        'password',
        'current_time',
        'is_playing',
    ];

    protected $casts = [
        'is_active'       => 'boolean',
        'is_private'      => 'boolean',
        'is_playing'      => 'boolean',
        'current_time'    => 'float',
        'max_participants' => 'integer',
        'episode_number'  => 'integer',
    ];

    public function anime(): BelongsTo
    {
        return $this->belongsTo(Anime::class);
    }

    public function host(): BelongsTo
    {
        return $this->belongsTo(User::class, 'host_user_id');
    }

    public function participants(): HasMany
    {
        return $this->hasMany(WatchPartyParticipant::class, 'room_id');
    }

    public function activeParticipants(): HasMany
    {
        return $this->hasMany(WatchPartyParticipant::class, 'room_id')
            ->where('is_active', true);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(WatchPartyMessage::class, 'room_id');
    }

    public static function generateCode(): string
    {
        do {
            $code = strtoupper(substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZ23456789'), 0, 6));
        } while (self::where('code', $code)->exists());

        return $code;
    }
}

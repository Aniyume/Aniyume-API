<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'custom_status',
        'social_links',
        'is_online',
        'is_premium',
        'selected_profile_frame',
        'theme_value',
        'theme_type',
        'privacy_favorites',
        'privacy_watch_history',
        'privacy_ratings',
        'is_active',
        'is_banned',
        'ban_reason',
        'ban_expires_at',
        'last_login_at',
        'last_login_ip',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_online' => 'boolean',
        'is_premium' => 'boolean',
        'is_active' => 'boolean',
        'is_banned' => 'boolean',
        'ban_expires_at' => 'datetime',
        'last_login_at' => 'datetime',
        'social_links' => 'array',
    ];

    public function hasActiveBan(): bool
    {
        if (! $this->is_banned) {
            return false;
        }

        return $this->ban_expires_at === null || $this->ban_expires_at->isFuture();
    }

    public function clearExpiredBan(): bool
    {
        if (! $this->is_banned || $this->ban_expires_at === null || $this->ban_expires_at->isFuture()) {
            return false;
        }

        $this->forceFill([
            'is_banned' => false,
            'ban_reason' => null,
            'ban_expires_at' => null,
        ])->save();

        return true;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function watchHistory()
    {
        return $this->hasMany(WatchHistory::class);
    }

    public function animeList()
    {
        return $this->belongsToMany(Anime::class, 'anime_user')
            ->withPivot(['status', 'episodes_watched'])
            ->withTimestamps();
    }

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friendships', 'user_id', 'friend_id')
            ->wherePivot('status', 'accepted')
            ->withTimestamps();
    }

    public function friendRequests()
    {
        return $this->belongsToMany(User::class, 'friendships', 'friend_id', 'user_id')
            ->wherePivot('status', 'pending')
            ->withTimestamps();
    }

    public function hasRole(string $roleName): bool
    {
        return $this->roles()->where('name', $roleName)->exists();
    }
}

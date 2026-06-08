<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'user_id',
        'anime_id',
        'comment',
        'is_approved',
        'admin_hearted_at',
        'admin_hearted_by',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'admin_hearted_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function anime()
    {
        return $this->belongsTo(Anime::class);
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function reactions()
    {
        return $this->hasMany(CommentReaction::class);
    }

    public function adminHeartedBy()
    {
        return $this->belongsTo(User::class, 'admin_hearted_by');
    }
}

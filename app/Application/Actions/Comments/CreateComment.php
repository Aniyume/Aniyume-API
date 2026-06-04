<?php

namespace App\Application\Actions\Comments;

use App\Application\Services\AnimeCommentsCount;
use App\Models\Comment;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CreateComment
{
    public function __construct(
        private readonly AnimeCommentsCount $commentsCount,
    ) {}

    public function handle(int $userId, int $animeId, string $text): Comment
    {
        return DB::transaction(function () use ($userId, $animeId, $text) {
            $comment = Comment::create([
                'user_id' => $userId,
                'anime_id' => $animeId,
                'comment' => $text,
                'is_approved' => true,
            ]);

            $this->commentsCount->increment($animeId);
            Cache::forget("user_statistics_{$userId}");

            return $comment;
        });
    }
}

<?php

namespace App\Application\Actions\Comments;

use App\Application\Services\AnimeCommentsCount;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class DeleteComment
{
    public function __construct(
        private readonly AnimeCommentsCount $commentsCount,
    ) {
    }

    public function handle(Comment $comment): void
    {
        DB::transaction(function () use ($comment) {
            $animeId = $comment->anime_id;

            $comment->delete();

            $this->commentsCount->decrement($animeId);
        });
    }
}

<?php

namespace App\Application\Actions\Comments;

use App\Models\Comment;

class UpdateComment
{
    public function handle(Comment $comment, string $text): Comment
    {
        $comment->update([
            'comment' => $text,
        ]);

        return $comment;
    }
}

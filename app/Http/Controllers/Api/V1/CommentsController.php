<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\Api\V1\CommentResource;
use App\Models\Comment;
use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
        DB::beginTransaction();
        try {
            $comment = Comment::create([
                'user_id' => $request->user()->id,
                'anime_id' => $request->validated('anime_id'),
                'comment' => $request->validated('comment'),
                'is_approved' => true,
            ]);

            $anime = Anime::find($request->validated('anime_id'));
            if ($anime) {
                $anime->increment('comments_count');
            }

            DB::commit();

            $comment->load(['user', 'anime']);
            return new CommentResource($comment);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to add comment',
            ], 500);
        }
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $comment->update([
            'comment' => $request->validated('comment'),
        ]);

        $comment->load(['user', 'anime']);
        return new CommentResource($comment);
    }

    public function destroy(Request $request, Comment $comment)
    {
        $this->authorize('delete', $comment);

        DB::beginTransaction();
        try {
            $animeId = $comment->anime_id;
            $comment->delete();

            $anime = Anime::find($animeId);
            if ($anime) {
                $anime->decrement('comments_count');
            }

            DB::commit();

            return response()->json([
                'message' => 'Comment deleted successfully'
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to delete comment',
            ], 500);
        }
    }

    public function userComments(Request $request)
    {
        $comments = Comment::with(['anime', 'user'])
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return CommentResource::collection($comments);
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\CommentResource;
use App\Models\Comment;
use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CommentsController extends Controller
{
    public function index(Request $request, $animeSlug)
    {
        $anime = Anime::where('slug', $animeSlug)->firstOrFail();

        $comments = Comment::with('user')
            ->where('anime_id', $anime->id)
            ->where('is_approved', true)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return CommentResource::collection($comments);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'anime_id' => 'required|exists:anime,id',
            'comment' => 'required|string|min:3|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();
        try {
            $comment = Comment::create([
                'user_id' => $request->user()->id,
                'anime_id' => $request->anime_id,
                'comment' => $request->comment,
                'is_approved' => true,
            ]);

            $anime = Anime::find($request->anime_id);
            $anime->increment('comments_count');

            DB::commit();

            $comment->load(['user', 'anime']);
            return new CommentResource($comment);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to add comment',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, Comment $comment)
    {
        if ($comment->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'comment' => 'required|string|min:3|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $comment->update([
            'comment' => $request->comment,
        ]);

        $comment->load(['user', 'anime']);
        return new CommentResource($comment);
    }

    public function destroy(Request $request, Comment $comment)
    {
        if ($comment->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        DB::beginTransaction();
        try {
            $animeId = $comment->anime_id;
            $comment->delete();

            $anime = Anime::find($animeId);
            $anime->decrement('comments_count');

            DB::commit();

            return response()->json([
                'message' => 'Comment deleted successfully'
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to delete comment',
                'error' => $e->getMessage()
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

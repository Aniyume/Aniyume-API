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
use Illuminate\Support\Facades\Schema;

/**
 * @group Комментарии
 *
 * Управление комментариями пользователей к аниме.
 */
class CommentsController extends Controller
{
    /**
     * Список комментариев к аниме
     * @urlParam anime integer ID аниме. Example: 3
     */
    public function index(Anime $anime)
    {
        $comments = $anime->comments()
            ->with('user')
            ->where('is_approved', true)
            ->orderBy('created_at', 'desc')
            ->paginate(50);

        return CommentResource::collection($comments);
    }

    /**
     * Оставить комментарий
     * @authenticated
     * @bodyParam anime_id integer required ID аниме. Example: 3
     * @bodyParam comment string required Текст комментария (3-1000 симв). Example: Очень крутая серия!
     */
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
            if ($anime && Schema::hasColumn('anime', 'comments_count')) {
                $anime->increment('comments_count');
            }

            DB::commit();
            return new CommentResource($comment->load('user'));
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error'], 500);
        }
    }

    /**
     * Редактировать комментарий
     * @authenticated
     * @urlParam id integer ID комментария. Example: 4
     * @bodyParam comment string required Новый текст комментария. Example: Изменил свое мнение, 10/10!
     */
    public function update(UpdateCommentRequest $request, $id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $comment->update([
            'comment' => $request->validated('comment')
        ]);

        return new CommentResource($comment->load('user'));
    }

    /**
     * Удалить комментарий
     * @authenticated
     * @urlParam id integer ID комментария. Example: 4
     */
    public function destroy(Request $request, $id)
    {
        $comment = Comment::find($id);
        if (!$comment) return response()->json(['message' => 'Not found'], 404);

        if ($comment->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        DB::beginTransaction();
        try {
            $animeId = $comment->anime_id;
            $comment->delete();

            $anime = Anime::find($animeId);
            if ($anime && Schema::hasColumn('anime', 'comments_count')) {
                $anime->decrement('comments_count');
            }

            DB::commit();
            return response()->json(['message' => 'Deleted'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error'], 500);
        }
    }

    /**
     * Мои комментарии
     * @authenticated
     */
    public function userComments(Request $request)
    {
        $comments = Comment::with(['anime'])
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return CommentResource::collection($comments);
    }
}

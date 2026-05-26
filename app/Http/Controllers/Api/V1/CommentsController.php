<?php

namespace App\Http\Controllers\Api\V1;

use App\Application\Actions\Comments\CreateComment;
use App\Application\Actions\Comments\DeleteComment;
use App\Application\Actions\Comments\UpdateComment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\Api\V1\CommentResource;
use App\Models\Anime;
use App\Models\Comment;
use Illuminate\Http\Request;

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
    public function store(StoreCommentRequest $request, CreateComment $createComment)
    {
        try {
            $comment = $createComment->handle(
                $request->user()->id,
                (int) $request->validated('anime_id'),
                (string) $request->validated('comment')
            );

            return new CommentResource($comment->load('user'));
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }

    /**
     * Редактировать комментарий
     * @authenticated
     * @urlParam id integer ID комментария. Example: 4
     * @bodyParam comment string required Новый текст комментария. Example: Изменил свое мнение, 10/10!
     */
    public function update(UpdateCommentRequest $request, $id, UpdateComment $updateComment)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $comment = $updateComment->handle($comment, (string) $request->validated('comment'));

        return new CommentResource($comment->load('user'));
    }

    /**
     * Удалить комментарий
     * @authenticated
     * @urlParam id integer ID комментария. Example: 4
     */
    public function destroy(Request $request, $id, DeleteComment $deleteComment)
    {
        $comment = Comment::find($id);
        if (!$comment) return response()->json(['message' => 'Not found'], 404);

        if ($comment->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        try {
            $deleteComment->handle($comment);

            return response()->json(['message' => 'Deleted'], 200);
        } catch (\Exception $e) {
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

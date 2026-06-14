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
use App\Models\CommentReaction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * @group Комментарии
 *
 * Управление комментариями пользователей к аниме.
 */
class CommentsController extends Controller
{
    /**
     * Список комментариев к аниме
     *
     * @urlParam anime integer ID аниме. Example: 3
     */
    public function index(Request $request, Anime $anime)
    {
        $comments = $anime->comments()
            ->with(['user:id,name,email,avatar', 'replies.user:id,name,email,avatar'])
            ->withCount([
                'reactions as likes_count' => fn ($query) => $query->where('type', CommentReaction::TYPE_LIKE),
                'reactions as dislikes_count' => fn ($query) => $query->where('type', CommentReaction::TYPE_DISLIKE),
                'replies as replies_count',
            ])
            ->where('is_approved', true)
            ->whereNull('parent_id')
            ->orderBy('created_at', 'desc')
            ->paginate(50);

        $this->attachViewerReactions($comments->getCollection(), $request);

        return CommentResource::collection($comments);
    }

    /**
     * Оставить комментарий
     *
     * @authenticated
     *
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
     *
     * @authenticated
     *
     * @urlParam id integer ID комментария. Example: 4
     *
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
     *
     * @authenticated
     *
     * @urlParam id integer ID комментария. Example: 4
     */
    public function destroy(Request $request, $id, DeleteComment $deleteComment)
    {
        $comment = Comment::query()->find($id);
        if (! $comment) {
            return response()->json(['message' => 'Not found'], 404);
        }

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
     *
     * @authenticated
     */
    public function userComments(Request $request)
    {
        $comments = Comment::with(['anime:id,title,slug,poster_url'])
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(50);

        return CommentResource::collection($comments);
    }

    public function react(Request $request, Comment $comment)
    {
        $validated = $request->validate([
            'type' => ['required', 'string', Rule::in([CommentReaction::TYPE_LIKE, CommentReaction::TYPE_DISLIKE])],
        ]);

        $existing = CommentReaction::query()
            ->where('comment_id', $comment->id)
            ->where('user_id', $request->user()->id)
            ->first();

        if ($existing && $existing->type === $validated['type']) {
            $existing->delete();
        } else {
            CommentReaction::query()->updateOrCreate(
                ['comment_id' => $comment->id, 'user_id' => $request->user()->id],
                ['type' => $validated['type']]
            );
        }

        return new CommentResource($this->commentWithInteractions($comment->refresh(), $request));
    }

    public function adminHeart(Request $request, Comment $comment)
    {
        abort_unless($request->user()?->roles()->where('name', 'admin')->exists(), 403, 'Only admins can heart comments.');

        $comment->update([
            'admin_hearted_at' => $comment->admin_hearted_at ? null : now(),
            'admin_hearted_by' => $comment->admin_hearted_at ? null : $request->user()->id,
        ]);

        return new CommentResource($this->commentWithInteractions($comment->refresh(), $request));
    }

    public function reply(Request $request, Comment $comment)
    {
        $validated = $request->validate([
            'comment' => ['required', 'string', 'min:2', 'max:1000', new \App\Http\Rules\PassesModeration(\App\Domain\Moderation\ModerationMode::Medium), new \App\Http\Rules\PassesAiModeration('comment_reply')],
        ]);

        $reply = Comment::query()->create([
            'parent_id' => $comment->id,
            'anime_id' => $comment->anime_id,
            'user_id' => $request->user()->id,
            'comment' => $validated['comment'],
            'is_approved' => true,
        ]);

        return new CommentResource($reply->load('user'));
    }

    private function commentWithInteractions(Comment $comment, Request $request): Comment
    {
        $comment->load(['user:id,name,email,avatar', 'replies.user:id,name,email,avatar']);
        $comment->loadCount([
            'reactions as likes_count' => fn ($query) => $query->where('type', CommentReaction::TYPE_LIKE),
            'reactions as dislikes_count' => fn ($query) => $query->where('type', CommentReaction::TYPE_DISLIKE),
        ]);
        $this->attachViewerReactions(collect([$comment]), $request);

        return $comment;
    }

    private function attachViewerReactions($comments, Request $request): void
    {
        $userId = $request->user()?->id;
        if (! $userId) {
            return;
        }

        $ids = $comments->pluck('id')->all();
        $reactions = CommentReaction::query()
            ->where('user_id', $userId)
            ->whereIn('comment_id', $ids)
            ->pluck('type', 'comment_id');

        $comments->each(function (Comment $comment) use ($reactions) {
            $comment->setAttribute('viewer_reaction', $reactions[$comment->id] ?? null);
        });
    }
}

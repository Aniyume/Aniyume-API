<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Admin\Concerns\BuildsPaginationMeta;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdminCommentResource;
use App\Models\AuditLog;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CommentController extends Controller
{
    use BuildsPaginationMeta;

    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'page' => ['sometimes', 'integer', 'min:1'],
            'per_page' => ['sometimes', 'integer', 'min:1', 'max:100'],
            'search' => ['sometimes', 'string', 'max:255'],
            'status' => ['sometimes', 'string', Rule::in(['approved', 'rejected'])],
            'user_id' => ['sometimes', 'integer', 'exists:users,id'],
            'anime_id' => ['sometimes', 'integer', 'exists:anime,id'],
        ]);

        $query = Comment::query()
            ->with(['user.roles', 'anime'])
            ->when($validated['search'] ?? null, fn ($query, string $search) => $query->where('comment', 'like', "%{$search}%"))
            ->when($validated['status'] ?? null, fn ($query, string $status) => $query->where('is_approved', $status === 'approved'))
            ->when($validated['user_id'] ?? null, fn ($query, int $userId) => $query->where('user_id', $userId))
            ->when($validated['anime_id'] ?? null, fn ($query, int $animeId) => $query->where('anime_id', $animeId))
            ->latest();

        $paginator = $query->paginate($validated['per_page'] ?? 20)->withQueryString();

        return response()->json([
            'data' => AdminCommentResource::collection($paginator->getCollection())->resolve($request),
            'links' => $this->paginationLinks($paginator),
            'meta' => $this->paginationMeta($paginator),
        ]);
    }

    public function approve(Request $request, Comment $comment): JsonResponse
    {
        $comment->update(['is_approved' => true]);
        $this->audit($request, 'approve_comment', "Approved comment ID {$comment->id}");

        return response()->json(['data' => (new AdminCommentResource($comment->refresh()->load(['user', 'anime'])))->resolve($request)]);
    }

    public function reject(Request $request, Comment $comment): JsonResponse
    {
        $comment->update(['is_approved' => false]);
        $this->audit($request, 'reject_comment', "Rejected comment ID {$comment->id}");

        return response()->json(['data' => (new AdminCommentResource($comment->refresh()->load(['user', 'anime'])))->resolve($request)]);
    }

    public function destroy(Request $request, Comment $comment): JsonResponse
    {
        $id = $comment->id;
        $comment->delete();
        $this->audit($request, 'delete_comment', "Deleted comment ID {$id}");

        return response()->json(null, 204);
    }

    private function audit(Request $request, string $action, string $description): void
    {
        AuditLog::create([
            'user_id' => $request->user()?->id,
            'action' => $action,
            'description' => $description,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'created_at' => now(),
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api\Admin;

use App\Application\Actions\Ratings\DeleteRating;
use App\Http\Controllers\Api\Admin\Concerns\BuildsPaginationMeta;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdminRatingResource;
use App\Models\AuditLog;
use App\Models\Rating;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RatingController extends Controller
{
    use BuildsPaginationMeta;

    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'page' => ['sometimes', 'integer', 'min:1'],
            'per_page' => ['sometimes', 'integer', 'min:1', 'max:100'],
            'anime_id' => ['sometimes', 'integer', 'exists:anime,id'],
            'user_id' => ['sometimes', 'integer', 'exists:users,id'],
            'rating' => ['sometimes', 'numeric', 'between:1,10'],
            'min_rating' => ['sometimes', 'numeric', 'between:1,10'],
            'max_rating' => ['sometimes', 'numeric', 'between:1,10'],
            'sort' => ['sometimes', 'string', Rule::in(['created_at', 'updated_at', 'rating'])],
            'direction' => ['sometimes', 'string', Rule::in(['asc', 'desc'])],
        ]);

        $query = Rating::query()
            ->with(['user', 'anime'])
            ->when($validated['anime_id'] ?? null, fn ($query, int $animeId) => $query->where('anime_id', $animeId))
            ->when($validated['user_id'] ?? null, fn ($query, int $userId) => $query->where('user_id', $userId))
            ->when($validated['rating'] ?? null, fn ($query, float $rating) => $query->where('rating', $rating))
            ->when($validated['min_rating'] ?? null, fn ($query, float $rating) => $query->where('rating', '>=', $rating))
            ->when($validated['max_rating'] ?? null, fn ($query, float $rating) => $query->where('rating', '<=', $rating));

        $query->orderBy($validated['sort'] ?? 'updated_at', $validated['direction'] ?? 'desc');
        $paginator = $query->paginate($validated['per_page'] ?? 50)->withQueryString();

        return response()->json([
            'data' => AdminRatingResource::collection($paginator->getCollection())->resolve($request),
            'links' => $this->paginationLinks($paginator),
            'meta' => $this->paginationMeta($paginator),
            'stats' => $this->stats($validated),
        ]);
    }

    public function destroy(Request $request, Rating $rating, DeleteRating $deleteRating): JsonResponse
    {
        $id = $rating->id;
        $animeId = $rating->anime_id;
        $userId = $rating->user_id;
        $value = $rating->rating;
        $deleteRating->handle($rating);
        $this->audit($request, 'delete_rating', "Deleted rating #{$id}: {$value} for anime ID {$animeId} by user ID {$userId}");

        return response()->json(null, 204);
    }

    private function stats(array $filters): array
    {
        $query = Rating::query()
            ->when($filters['anime_id'] ?? null, fn ($query, int $animeId) => $query->where('anime_id', $animeId))
            ->when($filters['user_id'] ?? null, fn ($query, int $userId) => $query->where('user_id', $userId));

        return [
            'total' => (clone $query)->count(),
            'average' => round((float) (clone $query)->avg('rating'), 2),
            'suspicious_low' => (clone $query)->where('rating', '<=', 2)->count(),
            'suspicious_high' => (clone $query)->where('rating', '>=', 9.5)->count(),
            'distribution' => (clone $query)
                ->selectRaw('FLOOR(rating) as bucket, COUNT(*) as count')
                ->groupBy('bucket')
                ->orderBy('bucket')
                ->get()
                ->map(fn ($item) => ['bucket' => (int) $item->bucket, 'count' => (int) $item->count])
                ->values()
                ->all(),
        ];
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

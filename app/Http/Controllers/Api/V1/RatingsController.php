<?php

namespace App\Http\Controllers\Api\V1;

use App\Application\Actions\Ratings\DeleteRating;
use App\Application\Actions\Ratings\UpsertRating;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRatingRequest;
use App\Http\Resources\Api\V1\RatingResource;
use App\Models\Rating;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Рейтинги
 * @authenticated
 */
class RatingsController extends Controller
{
    /**
     * Мои оценки
     */
    public function index(Request $request): JsonResponse
    {
        $ratings = Rating::with('anime')
            ->where('user_id', $request->user()->id)
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        return response()->json([
            'data' => RatingResource::collection($ratings),
            'pagination' => [
                'total' => $ratings->total(),
                'per_page' => $ratings->perPage(),
                'current_page' => $ratings->currentPage(),
                'last_page' => $ratings->lastPage(),
            ],
        ]);
    }

    /**
     * Поставить оценку
     * @bodyParam anime_id integer required ID аниме. Example: 3
     * @bodyParam rating number required Оценка (1-5). Example: 4.5
     */
    public function store(StoreRatingRequest $request, UpsertRating $upsertRating): JsonResponse
    {
        try {
            $rating = $upsertRating->handle(
                $request->user()->id,
                (int) $request->validated('anime_id'),
                (float) $request->validated('rating')
            );

            return response()->json([
                'message' => 'Rating added',
                'data' => new RatingResource($rating->load('anime')),
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to add rating'], 500);
        }
    }

    /**
     * Удалить оценку
     * @urlParam rating integer ID оценки. Example: 2
     */
    public function destroy(Request $request, Rating $rating, DeleteRating $deleteRating): JsonResponse
    {
        if ($rating->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        try {
            $deleteRating->handle($rating);

            return response()->json(['message' => 'Rating deleted'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete rating'], 500);
        }
    }

    /**
     * Моя оценка конкретного аниме
     * @urlParam animeId integer ID аниме. Example: 3
     */
    public function getUserRating(Request $request, $animeId): JsonResponse
    {
        $rating = Rating::where('user_id', $request->user()->id)
            ->where('anime_id', $animeId)
            ->first();

        return response()->json(['rating' => $rating?->rating]);
    }
}

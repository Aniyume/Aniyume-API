<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\RatingResource;
use App\Models\Rating;
use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RatingsController extends Controller
{
    public function index(Request $request)
    {
        $ratings = Rating::with('anime')
            ->where('user_id', $request->user()->id)
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        return RatingResource::collection($ratings);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'anime_id' => 'required|exists:anime,id',
            'rating' => 'required|numeric|min:1|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();
        try {
            $existingRating = Rating::where('user_id', $request->user()->id)
                ->where('anime_id', $request->anime_id)
                ->first();

            if ($existingRating) {
                $oldRating = $existingRating->rating;
                $existingRating->update(['rating' => $request->rating]);
                
                $anime = Anime::find($request->anime_id);
                $anime->rating_sum = $anime->rating_sum - $oldRating + $request->rating;
                $anime->rating = round($anime->rating_sum / $anime->ratings_count, 1);
                $anime->save();

                DB::commit();

                $existingRating->load('anime');
                return new RatingResource($existingRating);
            }

            $rating = Rating::create([
                'user_id' => $request->user()->id,
                'anime_id' => $request->anime_id,
                'rating' => $request->rating,
            ]);

            $anime = Anime::find($request->anime_id);
            $anime->increment('ratings_count');
            $anime->rating_sum += $request->rating;
            $anime->rating = round($anime->rating_sum / $anime->ratings_count, 1);
            $anime->save();

            DB::commit();

            $rating->load('anime');
            return new RatingResource($rating);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to add rating',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Request $request, $animeId)
    {
        $rating = Rating::where('user_id', $request->user()->id)
            ->where('anime_id', $animeId)
            ->first();

        if (!$rating) {
            return response()->json([
                'message' => 'Rating not found'
            ], 404);
        }

        DB::beginTransaction();
        try {
            $ratingValue = $rating->rating;
            $rating->delete();

            $anime = Anime::find($animeId);
            $anime->decrement('ratings_count');
            $anime->rating_sum -= $ratingValue;
            
            if ($anime->ratings_count > 0) {
                $anime->rating = round($anime->rating_sum / $anime->ratings_count, 1);
            } else {
                $anime->rating = null;
            }
            $anime->save();

            DB::commit();

            return response()->json([
                'message' => 'Rating deleted successfully'
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to delete rating',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getUserRating(Request $request, $animeId)
    {
        $rating = Rating::where('user_id', $request->user()->id)
            ->where('anime_id', $animeId)
            ->first();

        if (!$rating) {
            return response()->json([
                'rating' => null
            ]);
        }

        return response()->json([
            'rating' => $rating->rating
        ]);
    }
}

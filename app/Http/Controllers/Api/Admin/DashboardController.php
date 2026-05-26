<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminAnimeResource;
use App\Http\Resources\AdminImportLogResource;
use App\Models\Anime;
use App\Models\Episode;
use App\Models\ImportLog;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $recentImports = ImportLog::latest()->take(5)->get();
        $latestAnime = Anime::with('tags')->withCount('episodes')->latest()->take(10)->get();

        return response()->json([
            'data' => [
                'summary' => [
                    'total_anime' => Anime::count(),
                    'total_episodes' => Episode::count(),
                    'total_tags' => Tag::count(),
                    'total_users' => User::count(),
                ],
                'recent_imports' => AdminImportLogResource::collection($recentImports)->resolve(request()),
                'anime_by_status' => $this->groupAnimeBy('status'),
                'anime_by_type' => $this->groupAnimeBy('type'),
                'latest_anime' => AdminAnimeResource::collection($latestAnime)->resolve(request()),
            ],
        ]);
    }

    private function groupAnimeBy(string $column): array
    {
        return Anime::query()
            ->selectRaw("{$column}, COUNT(*) as count")
            ->groupBy($column)
            ->orderBy($column)
            ->get()
            ->map(fn ($item) => [
                $column => $item->{$column},
                'count' => (int) $item->count,
            ])
            ->values()
            ->all();
    }
}

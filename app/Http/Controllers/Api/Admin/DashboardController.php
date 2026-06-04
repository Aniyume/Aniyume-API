<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminAnimeResource;
use App\Http\Resources\AdminImportLogResource;
use App\Models\Anime;
use App\Models\AuditLog;
use App\Models\Comment;
use App\Models\Episode;
use App\Models\ImportLog;
use App\Models\Report;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $data = Cache::remember('admin_dashboard_summary', now()->addMinutes(2), function () {
            $recentImports = ImportLog::query()->latest()->take(5)->get();
            $latestAnime = Anime::query()->with('tags')->withCount('episodes')->latest()->take(10)->get();
            $topAnimeByRating = Anime::query()->with('tags')->withCount('episodes')->whereNotNull('rating')->orderByDesc('rating')->take(10)->get();

            return [
                'summary' => [
                    'total_anime' => Anime::query()->count(),
                    'total_episodes' => Episode::query()->count(),
                    'total_tags' => Tag::query()->count(),
                    'total_users' => User::query()->count(),
                    'total_comments' => Comment::query()->count(),
                    'new_users_today' => User::query()->where('created_at', '>=', now()->startOfDay())->count(),
                    'new_comments_today' => Comment::query()->where('created_at', '>=', now()->startOfDay())->count(),
                    'audit_events_today' => AuditLog::query()->where('created_at', '>=', now()->startOfDay())->count(),
                    'total_reports' => class_exists(Report::class) ? Report::query()->count() : 0,
                    'pending_reports' => class_exists(Report::class) ? Report::query()->where('status', Report::STATUS_PENDING)->count() : 0,
                ],
                'recent_imports' => AdminImportLogResource::collection($recentImports)->resolve(request()),
                'anime_by_status' => $this->groupAnimeBy('status'),
                'anime_by_type' => $this->groupAnimeBy('type'),
                'latest_anime' => AdminAnimeResource::collection($latestAnime)->resolve(request()),
                'top_anime_by_rating' => AdminAnimeResource::collection($topAnimeByRating)->resolve(request()),
            ];
        });

        return response()->json(['data' => $data]);
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

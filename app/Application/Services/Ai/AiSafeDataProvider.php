<?php

namespace App\Application\Services\Ai;

use App\Models\Anime;
use App\Models\Episode;
use App\Models\ImportLog;
use App\Models\Tag;
use App\Models\User;

final class AiSafeDataProvider
{
    /**
     * @return array<string, mixed>
     */
    public function searchAnime(string $query, int $limit): array
    {
        $limit = max(1, min($limit, 10));

        $items = Anime::query()
            ->select(['id', 'title', 'slug', 'poster_url', 'type', 'status', 'year', 'rating'])
            ->when($query !== '', function ($builder) use ($query) {
                $search = '%'.$query.'%';

                $builder->where(function ($subQuery) use ($search) {
                    $subQuery->where('title', 'like', $search)
                        ->orWhere('slug', 'like', $search);
                });
            })
            ->where(function ($builder) {
                $builder->whereNull('nsfw_flag')->orWhere('nsfw_flag', false);
            })
            ->orderByDesc('popularity')
            ->orderByDesc('rating')
            ->limit($limit)
            ->get()
            ->map(fn (Anime $anime) => [
                'id' => $anime->id,
                'title' => $anime->title,
                'slug' => $anime->slug,
                'poster_url' => $anime->poster_url,
                'type' => $anime->type,
                'status' => $anime->status,
                'year' => $anime->year,
                'rating' => $anime->rating,
            ])
            ->values()
            ->all();

        return [
            'query' => $query,
            'count' => count($items),
            'items' => $items,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function currentUserAnimeList(User $user, string $status, int $limit): array
    {
        $allowedStatuses = ['watching', 'planned', 'completed', 'on_hold', 'dropped'];
        $limit = max(1, min($limit, 20));

        $items = $user->animeList()
            ->select(['anime.id', 'anime.title', 'anime.slug', 'anime.poster_url', 'anime.type', 'anime.status', 'anime.number_of_episodes'])
            ->when(in_array($status, $allowedStatuses, true), fn ($builder) => $builder->wherePivot('status', $status))
            ->limit($limit)
            ->get()
            ->map(function (Anime $anime) {
                $pivot = $anime->getRelationValue('pivot');

                return [
                    'id' => $anime->id,
                    'title' => $anime->title,
                    'slug' => $anime->slug,
                    'poster_url' => $anime->poster_url,
                    'type' => $anime->type,
                    'anime_status' => $anime->status,
                    'list_status' => $pivot?->getAttribute('status'),
                    'episodes_watched' => $pivot?->getAttribute('episodes_watched'),
                    'episodes_total' => $anime->number_of_episodes,
                ];
            })
            ->values()
            ->all();

        return [
            'status' => in_array($status, $allowedStatuses, true) ? $status : 'all',
            'count' => count($items),
            'items' => $items,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function currentUserProfileSummary(User $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'avatar' => $user->avatar,
            'bio' => $user->bio,
            'custom_status' => $user->custom_status,
            'is_premium' => (bool) $user->is_premium,
            'roles' => $user->roles()->pluck('name')->values()->all(),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function adminDashboardSummary(): array
    {
        return [
            'total_anime' => Anime::query()->count('*'),
            'total_episodes' => Episode::query()->count('*'),
            'total_tags' => Tag::query()->count('*'),
            'total_users' => User::query()->count('*'),
            'recent_imports' => ImportLog::query()
                ->latest()
                ->limit(5)
                ->get(['id', 'import_type', 'status', 'started_at', 'finished_at'])
                ->map(fn (ImportLog $log) => [
                    'id' => $log->id,
                    'import_type' => $log->import_type,
                    'status' => $log->status,
                    'started_at' => $log->started_at,
                    'finished_at' => $log->finished_at,
                ])
                ->values()
                ->all(),
        ];
    }
}

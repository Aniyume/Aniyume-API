<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Admin\Concerns\BuildsPaginationMeta;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdminEpisodeResource;
use App\Jobs\EpisodesImportJob;
use App\Models\Anime;
use App\Models\AuditLog;
use App\Models\Episode;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EpisodeController extends Controller
{
    use BuildsPaginationMeta;

    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'page' => ['sometimes', 'integer', 'min:1'],
            'per_page' => ['sometimes', 'integer', 'min:1', 'max:100'],
            'anime_id' => ['sometimes', 'integer', 'exists:anime,id'],
            'search' => ['sometimes', 'string', 'max:255'],
            'source' => ['sometimes', 'string', 'max:80'],
            'sort' => ['sometimes', 'string', Rule::in(['created_at', 'updated_at', 'episode_number', 'aired_at', 'release_date'])],
            'direction' => ['sometimes', 'string', Rule::in(['asc', 'desc'])],
        ]);

        $query = Episode::query()
            ->with('anime')
            ->when($validated['anime_id'] ?? null, fn ($query, int $animeId) => $query->where('anime_id', $animeId))
            ->when($validated['source'] ?? null, fn ($query, string $source) => $query->where('source', $source))
            ->when($validated['search'] ?? null, function ($query, string $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('translator', 'like', "%{$search}%")
                        ->orWhereHas('anime', fn ($query) => $query->where('title', 'like', "%{$search}%"));
                });
            });

        $sort = $validated['sort'] ?? 'updated_at';
        $direction = $validated['direction'] ?? 'desc';
        $query->orderBy($sort, $direction)->orderBy('id', 'desc');

        $paginator = $query->paginate($validated['per_page'] ?? 50)->withQueryString();

        return response()->json([
            'data' => AdminEpisodeResource::collection($paginator->getCollection())->resolve($request),
            'links' => $this->paginationLinks($paginator),
            'meta' => $this->paginationMeta($paginator),
        ]);
    }

    public function show(Request $request, Episode $episode): JsonResponse
    {
        return response()->json([
            'data' => (new AdminEpisodeResource($episode->load('anime')))->resolve($request),
        ]);
    }

    public function update(Request $request, Episode $episode): JsonResponse
    {
        $validated = $request->validate([
            'episode_number' => ['sometimes', 'integer', 'min:0'],
            'season_number' => ['nullable', 'integer', 'min:0'],
            'title' => ['nullable', 'string', 'max:255'],
            'player_url' => ['nullable', 'url', 'max:2048'],
            'player_iframe' => ['nullable', 'string'],
            'aired_at' => ['nullable', 'date'],
            'release_date' => ['nullable', 'date'],
            'duration' => ['nullable', 'integer', 'min:0'],
            'thumbnail_url' => ['nullable', 'url', 'max:2048'],
            'translator' => ['nullable', 'string', 'max:255'],
            'quality' => ['nullable', 'string', 'max:80'],
            'source' => ['nullable', 'string', 'max:80'],
        ]);

        $episode->update($validated);
        $this->audit($request, 'update_episode', "Updated episode #{$episode->episode_number} for anime ID {$episode->anime_id}");

        return response()->json([
            'data' => (new AdminEpisodeResource($episode->refresh()->load('anime')))->resolve($request),
        ]);
    }

    public function destroy(Request $request, Episode $episode): JsonResponse
    {
        $id = $episode->id;
        $animeId = $episode->anime_id;
        $episodeNumber = $episode->episode_number;
        $episode->delete();
        $this->audit($request, 'delete_episode', "Deleted episode ID {$id} (#{$episodeNumber}) for anime ID {$animeId}");

        return response()->json(null, 204);
    }

    public function importForAnime(Request $request, Anime $anime): JsonResponse
    {
        EpisodesImportJob::dispatch($anime->id, false);
        $this->audit($request, 'import_episodes', "Started episodes import for anime {$anime->title} (ID {$anime->id})");

        return response()->json([
            'data' => [
                'message' => 'Episodes import queued',
                'anime_id' => $anime->id,
            ],
        ], 202);
    }

    public function bulkImport(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'anime_ids' => ['nullable', 'array'],
            'anime_ids.*' => ['integer', 'exists:anime,id'],
        ]);

        $animeIds = $validated['anime_ids'] ?? Anime::query()->pluck('id')->all();
        foreach ($animeIds as $animeId) {
            EpisodesImportJob::dispatch((int) $animeId, false);
        }

        $this->audit($request, 'bulk_import_episodes', 'Started episodes bulk import for '.count($animeIds).' anime');

        return response()->json([
            'data' => [
                'message' => 'Episodes bulk import queued',
                'queued_count' => count($animeIds),
            ],
        ], 202);
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

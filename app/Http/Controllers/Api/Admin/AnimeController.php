<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Admin\Concerns\BuildsPaginationMeta;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ListAdminAnimeRequest;
use App\Http\Requests\Admin\StoreAdminAnimeRequest;
use App\Http\Requests\Admin\UpdateAdminAnimeRequest;
use App\Http\Resources\AdminAnimeResource;
use App\Models\Anime;
use App\Models\AuditLog;
use App\Models\BlacklistedAnime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class AnimeController extends Controller
{
    use BuildsPaginationMeta;

    public function index(ListAdminAnimeRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $sort = $validated['sort'] ?? 'created_at';
        $direction = $validated['direction'] ?? 'desc';

        $query = Anime::query()
            ->with('tags')
            ->withCount('episodes')
            ->when($validated['search'] ?? null, function ($query, string $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%");
                });
            })
            ->when($validated['status'] ?? null, fn ($query, string $status) => $query->where('status', $status))
            ->when($validated['type'] ?? null, fn ($query, string $type) => $query->where('type', $type))
            ->when(array_key_exists('nsfw_flag', $validated), fn ($query) => $query->where('nsfw_flag', $validated['nsfw_flag']))
            ->when($validated['tag_id'] ?? null, fn ($query, int $tagId) => $query->whereHas('tags', fn ($query) => $query->where('tags.id', $tagId)));

        $query->orderBy($sort, $direction);

        $paginator = $query->paginate($validated['per_page'] ?? 20)->withQueryString();

        return response()->json([
            'data' => AdminAnimeResource::collection($paginator->getCollection())->resolve($request),
            'links' => $this->paginationLinks($paginator),
            'meta' => $this->paginationMeta($paginator),
        ]);
    }

    public function store(StoreAdminAnimeRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $tagIds = $validated['tags'] ?? null;
        $attributes = Arr::except($validated, ['tags']);

        $attributes['slug'] = Str::slug($attributes['title']);
        $attributes['nsfw_flag'] = $validated['nsfw_flag'] ?? false;

        $anime = Anime::create($attributes);

        if ($tagIds !== null) {
            $anime->tags()->sync($tagIds);
        }

        $this->audit($request, 'create_anime', "Created anime: {$anime->title}");

        return response()->json([
            'data' => (new AdminAnimeResource($anime->load('tags')->loadCount('episodes')))->resolve($request),
        ], 201);
    }

    public function update(UpdateAdminAnimeRequest $request, Anime $anime): JsonResponse
    {
        $validated = $request->validated();
        $tagIds = $validated['tags'] ?? null;
        $attributes = Arr::except($validated, ['tags']);

        if (array_key_exists('title', $attributes)) {
            $attributes['slug'] = Str::slug($attributes['title']);
        }

        $anime->update($attributes);

        if (array_key_exists('tags', $validated)) {
            $anime->tags()->sync($tagIds ?? []);
        }

        $this->audit($request, 'update_anime', "Updated anime: {$anime->title}");

        return response()->json([
            'data' => (new AdminAnimeResource($anime->refresh()->load('tags')->loadCount('episodes')))->resolve($request),
        ]);
    }

    public function destroy(Request $request, Anime $anime): JsonResponse
    {
        $id = $anime->id;
        $title = $anime->title;

        if ($anime->external_id) {
            BlacklistedAnime::firstOrCreate([
                'external_id' => $anime->external_id,
                'external_source' => $anime->external_source ?? 'anilist',
            ]);
        }

        $anime->delete();

        $this->audit($request, 'delete_anime', "Deleted anime: {$title} (ID: {$id}) and added to blacklist");

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

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
use App\Services\AuditService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
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

    public function show(Request $request, Anime $anime): JsonResponse
    {
        $anime->load('tags');
        $anime->loadCount(['episodes', 'comments', 'ratings']);

        return response()->json([
            'data' => (new AdminAnimeResource($anime))->resolve($request),
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

        app(AuditService::class)->log($request, 'create_anime', "Created anime: {$anime->title}", $anime, null, $anime->fresh()->toArray());

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

        $before = $anime->getOriginal();
        $anime->update($attributes);

        if (array_key_exists('tags', $validated)) {
            $anime->tags()->sync($tagIds ?? []);
        }

        app(AuditService::class)->log($request, 'update_anime', "Updated anime: {$anime->title}", $anime, $before, $anime->fresh()->toArray(), ['changed' => array_keys($attributes)]);

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

        app(AuditService::class)->log($request, 'delete_anime', "Deleted anime: {$title} (ID: {$id}) and added to blacklist", null, ['id' => $id, 'title' => $title], null);

        return response()->json(null, 204);
    }

    public function uploadPoster(Request $request, Anime $anime): JsonResponse
    {
        return $this->uploadImage($request, $anime, 'poster', 'poster_url', 'anime/posters');
    }

    public function deletePoster(Request $request, Anime $anime): JsonResponse
    {
        return $this->deleteImage($request, $anime, 'poster', 'poster_url');
    }

    public function uploadCover(Request $request, Anime $anime): JsonResponse
    {
        return $this->uploadImage($request, $anime, 'cover', 'cover_url', 'anime/covers');
    }

    public function deleteCover(Request $request, Anime $anime): JsonResponse
    {
        return $this->deleteImage($request, $anime, 'cover', 'cover_url');
    }

    private function uploadImage(Request $request, Anime $anime, string $kind, string $column, string $directory): JsonResponse
    {
        $validated = $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $oldUrl = $anime->{$column};
        /** @var UploadedFile $image */
        $image = $validated['image'];
        $path = $image->store($directory, 'public');
        $anime->update([$column => url(Storage::url($path))]);
        $this->deleteLocalPublicUrl($oldUrl);
        app(AuditService::class)->log($request, "upload_anime_{$kind}", "Uploaded {$kind} for anime {$anime->title} (ID {$anime->id})", $anime, [$column => $oldUrl], [$column => $anime->{$column}]);

        return response()->json([
            'data' => (new AdminAnimeResource($anime->refresh()->load('tags')))->resolve($request),
        ]);
    }

    private function deleteImage(Request $request, Anime $anime, string $kind, string $column): JsonResponse
    {
        $oldUrl = $anime->{$column};
        $anime->update([$column => null]);
        $this->deleteLocalPublicUrl($oldUrl);
        app(AuditService::class)->log($request, "delete_anime_{$kind}", "Deleted {$kind} for anime {$anime->title} (ID {$anime->id})", $anime, [$column => $oldUrl], [$column => null]);

        return response()->json([
            'data' => (new AdminAnimeResource($anime->refresh()->load('tags')))->resolve($request),
        ]);
    }

    private function deleteLocalPublicUrl(?string $url): void
    {
        if (! $url) {
            return;
        }

        $storagePrefix = '/storage/';
        $position = strpos($url, $storagePrefix);
        if ($position === false) {
            return;
        }

        $path = substr($url, $position + strlen($storagePrefix));
        if ($path) {
            Storage::disk('public')->delete($path);
        }
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

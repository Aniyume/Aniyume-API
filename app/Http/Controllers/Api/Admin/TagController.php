<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Admin\Concerns\BuildsPaginationMeta;
use App\Http\Requests\Admin\StoreAdminTagRequest;
use App\Http\Requests\Admin\UpdateAdminTagRequest;
use App\Http\Resources\AdminTagResource;
use App\Models\AuditLog;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    use BuildsPaginationMeta;

    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'page' => ['sometimes', 'integer', 'min:1'],
            'per_page' => ['sometimes', 'integer', 'min:1', 'max:100'],
            'search' => ['sometimes', 'string', 'max:255'],
        ]);

        $query = Tag::query()
            ->withCount('anime')
            ->when($validated['search'] ?? null, function ($query, string $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            })
            ->orderBy('name');

        $paginator = $query->paginate($validated['per_page'] ?? 50)->withQueryString();

        return response()->json([
            'data' => AdminTagResource::collection($paginator->getCollection())->resolve($request),
            'links' => $this->paginationLinks($paginator),
            'meta' => $this->paginationMeta($paginator),
        ]);
    }

    public function show(Request $request, Tag $tag): JsonResponse
    {
        $tag->loadCount('anime');

        return response()->json([
            'data' => (new AdminTagResource($tag))->resolve($request),
        ]);
    }

    public function store(StoreAdminTagRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['name']);

        $tag = Tag::create($validated);

        $this->audit($request, 'create_tag', "Created tag: {$tag->name}");

        return response()->json([
            'data' => (new AdminTagResource($tag))->resolve($request),
        ], 201);
    }

    public function update(UpdateAdminTagRequest $request, Tag $tag): JsonResponse
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['name']);

        $tag->update($validated);

        $this->audit($request, 'update_tag', "Updated tag: {$tag->name}");

        return response()->json([
            'data' => (new AdminTagResource($tag->refresh()))->resolve($request),
        ]);
    }

    public function destroy(Request $request, Tag $tag): JsonResponse
    {
        $name = $tag->name;

        $tag->delete();

        $this->audit($request, 'delete_tag', "Deleted tag: {$name}");

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

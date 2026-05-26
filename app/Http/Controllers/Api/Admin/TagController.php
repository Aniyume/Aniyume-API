<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
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

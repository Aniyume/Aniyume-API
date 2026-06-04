<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Admin\Concerns\BuildsPaginationMeta;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdminUserResource;
use App\Models\AuditLog;
use App\Models\User;
use App\Services\AuditService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    use BuildsPaginationMeta;

    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'page' => ['sometimes', 'integer', 'min:1'],
            'per_page' => ['sometimes', 'integer', 'min:1', 'max:100'],
            'search' => ['sometimes', 'string', 'max:255'],
            'role' => ['sometimes', 'string', 'max:80'],
            'banned' => ['sometimes', 'boolean'],
            'premium' => ['sometimes', 'boolean'],
            'online' => ['sometimes', 'boolean'],
            'sort' => ['sometimes', 'string', Rule::in(['created_at', 'updated_at', 'name', 'email', 'last_login_at'])],
            'direction' => ['sometimes', 'string', Rule::in(['asc', 'desc'])],
        ]);

        $query = User::query()
            ->with('roles')
            ->withCount(['comments', 'ratings', 'favorites'])
            ->when($validated['search'] ?? null, function ($query, string $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('id', $search);
                });
            })
            ->when($validated['role'] ?? null, fn ($query, string $role) => $query->whereHas('roles', fn ($query) => $query->where('name', $role)))
            ->when(array_key_exists('banned', $validated), fn ($query) => $query->where('is_banned', $validated['banned']))
            ->when(array_key_exists('premium', $validated), fn ($query) => $query->where('is_premium', $validated['premium']))
            ->when(array_key_exists('online', $validated), fn ($query) => $query->where('is_online', $validated['online']));

        $query->orderBy($validated['sort'] ?? 'created_at', $validated['direction'] ?? 'desc');
        $paginator = $query->paginate($validated['per_page'] ?? 20)->withQueryString();

        return response()->json([
            'data' => AdminUserResource::collection($paginator->getCollection())->resolve($request),
            'links' => $this->paginationLinks($paginator),
            'meta' => $this->paginationMeta($paginator),
        ]);
    }

    public function show(Request $request, User $user): JsonResponse
    {
        $user->load('roles');
        $user->loadCount(['comments', 'ratings', 'favorites']);

        return response()->json([
            'data' => (new AdminUserResource($user))->resolve($request),
        ]);
    }

    public function ban(Request $request, User $user): JsonResponse
    {
        $validated = $request->validate(['reason' => ['required', 'string', 'max:255']]);
        $before = $user->getOriginal();
        $user->update(['is_banned' => true, 'ban_reason' => $validated['reason']]);
        app(AuditService::class)->log($request, 'ban_user', "Banned user {$user->email}: {$validated['reason']}", $user, $before, $user->fresh()->toArray());

        return response()->json(['data' => (new AdminUserResource($user->refresh()->load('roles')))->resolve($request)]);
    }

    public function grantPremiumByNickname(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nickname' => ['required', 'string', 'max:255'],
        ]);

        $nickname = trim($validated['nickname']);
        $user = User::query()->where('name', $nickname)->first();
        abort_if(! $user, 404, 'Пользователь с таким ником не найден.');

        $before = $user->getOriginal();
        $user->update(['is_premium' => true]);
        app(AuditService::class)->log($request, 'grant_premium', "Granted premium to {$user->email} by nickname {$nickname}", $user, $before, $user->fresh()->toArray());

        return response()->json(['data' => (new AdminUserResource($user->refresh()->load('roles')))->resolve($request)]);
    }

    public function updatePremium(Request $request, User $user): JsonResponse
    {
        $validated = $request->validate([
            'is_premium' => ['required', 'boolean'],
        ]);

        $before = $user->getOriginal();
        $user->update(['is_premium' => (bool) $validated['is_premium']]);
        $action = $user->is_premium ? 'grant_premium' : 'revoke_premium';
        app(AuditService::class)->log($request, $action, ucfirst(str_replace('_', ' ', $action))." for {$user->email}", $user, $before, $user->fresh()->toArray());

        return response()->json(['data' => (new AdminUserResource($user->refresh()->load('roles')))->resolve($request)]);
    }

    public function unban(Request $request, User $user): JsonResponse
    {
        $before = $user->getOriginal();
        $user->update(['is_banned' => false, 'ban_reason' => null]);
        app(AuditService::class)->log($request, 'unban_user', "Unbanned user {$user->email}", $user, $before, $user->fresh()->toArray());

        return response()->json(['data' => (new AdminUserResource($user->refresh()->load('roles')))->resolve($request)]);
    }

    public function destroy(Request $request, User $user): JsonResponse
    {
        abort_if($request->user()?->id === $user->id, 422, 'You cannot delete your own admin account.');
        $email = $user->email;
        $user->delete();
        $this->audit($request, 'delete_user', "Deleted user {$email}");

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

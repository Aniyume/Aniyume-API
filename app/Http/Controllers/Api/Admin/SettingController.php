<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminSettingResource;
use App\Models\AuditLog;
use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Services\AuditService;

class SettingController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'group' => ['sometimes', 'string', 'max:80'],
        ]);

        $query = Setting::query()->orderBy('group')->orderBy('key');
        if ($validated['group'] ?? null) {
            $query->where('group', $validated['group']);
        }

        return response()->json([
            'data' => AdminSettingResource::collection($query->get())->resolve($request),
        ]);
    }

    public function update(Request $request, SettingService $settings): JsonResponse
    {
        $validated = $request->validate([
            'settings' => ['required', 'array'],
            'settings.*.key' => ['required', 'string', 'exists:settings,key'],
            'settings.*.value' => ['nullable'],
        ]);

        $updated = [];
        $before = [];
        foreach ($validated['settings'] as $item) {
            $existing = Setting::query()->where('key', $item['key'])->first();
            if ($existing) {
                $before[$existing->key] = $existing->typedValue();
            }
            $setting = $settings->set($item['key'], $item['value'] ?? null);
            if ($setting) {
                $updated[] = $setting;
            }
        }

        app(AuditService::class)->log($request, 'update_settings', 'Updated settings: '.implode(', ', array_column($validated['settings'], 'key')), null, $before, collect($updated)->mapWithKeys(fn (Setting $setting) => [$setting->key => $setting->typedValue()])->all());

        return response()->json([
            'data' => AdminSettingResource::collection(collect($updated))->resolve($request),
        ]);
    }

    public function diagnostics(): JsonResponse
    {
        return response()->json([
            'data' => [
                'app' => [
                    'name' => config('app.name'),
                    'env' => config('app.env'),
                    'debug' => (bool) config('app.debug'),
                    'url' => config('app.url'),
                    'laravel_version' => app()->version(),
                    'php_version' => PHP_VERSION,
                ],
                'drivers' => [
                    'cache' => config('cache.default'),
                    'queue' => config('queue.default'),
                    'filesystem' => config('filesystems.default'),
                    'session' => config('session.driver'),
                ],
                'storage' => [
                    'public_url' => Storage::url(''),
                    'public_disk_configured' => array_key_exists('public', config('filesystems.disks', [])),
                    'storage_link_exists' => is_link(public_path('storage')) || file_exists(public_path('storage')),
                ],
                'health' => [
                    'cache_write' => $this->checkCache(),
                    'settings_count' => Setting::count(),
                ],
            ],
        ]);
    }

    private function checkCache(): bool
    {
        try {
            Cache::put('admin.diagnostics.cache', 'ok', 10);
            return Cache::get('admin.diagnostics.cache') === 'ok';
        } catch (\Throwable) {
            return false;
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

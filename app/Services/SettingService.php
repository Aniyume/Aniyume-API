<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingService
{
    public function all(): array
    {
        return Cache::rememberForever('settings.all', fn () => Setting::query()
            ->orderBy('group')
            ->orderBy('key')
            ->get()
            ->keyBy('key')
            ->map(fn (Setting $setting) => $setting->typedValue())
            ->all());
    }

    public function forget(): void
    {
        Cache::forget('settings.all');
    }

    public function set(string $key, mixed $value): ?Setting
    {
        $setting = Setting::query()->where('key', $key)->first();
        if (! $setting) {
            return null;
        }

        $setting->update(['value' => $this->serialize($value, $setting->type)]);
        $this->forget();

        return $setting->refresh();
    }

    private function serialize(mixed $value, string $type): ?string
    {
        if ($value === null) {
            return null;
        }

        return match ($type) {
            'boolean' => filter_var($value, FILTER_VALIDATE_BOOLEAN) ? 'true' : 'false',
            'json' => json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            default => (string) $value,
        };
    }
}

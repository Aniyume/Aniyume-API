<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminSettingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'key' => $this->key,
            'value' => $this->typedValue(),
            'raw_value' => $this->value,
            'type' => $this->type,
            'group' => $this->group,
            'is_public' => (bool) $this->is_public,
            'is_encrypted' => (bool) $this->is_encrypted,
            'description' => $this->description,
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}

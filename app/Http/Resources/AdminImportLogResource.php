<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminImportLogResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'import_type' => $this->import_type,
            'status' => $this->status,
            'message' => $this->errors,
            'errors' => $this->errors,
            'started_at' => $this->started_at?->toISOString(),
            'completed_at' => $this->finished_at?->toISOString(),
            'finished_at' => $this->finished_at?->toISOString(),
            'total_processed' => (int) $this->total_processed,
            'total_created' => (int) $this->total_created,
            'total_updated' => (int) $this->total_updated,
            'total_skipped' => (int) $this->total_skipped,
            'anime_created' => (int) ($this->anime_created ?? 0),
            'episodes_created' => (int) ($this->episodes_created ?? 0),
            'banners_updated' => (int) ($this->banners_updated ?? 0),
            'content_counts' => [
                'anime' => (int) ($this->anime_created ?? 0),
                'episodes' => (int) ($this->episodes_created ?? 0),
                'banners' => (int) ($this->banners_updated ?? 0),
            ],
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}

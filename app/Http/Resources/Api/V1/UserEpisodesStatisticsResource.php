<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserEpisodesStatisticsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'total_episodes_today' => $this->resource['total_episodes_today'],
            'episodes_per_day_last_10_days' => $this->resource['episodes_per_day_last_10_days'],
            'average_episodes_last_10_days' => $this->resource['average_episodes_last_10_days'],
        ];
    }
}

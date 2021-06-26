<?php

namespace App\Http\Resources\Team;

use App\Models\Team;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TeamsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'items' => $this->collection->transform(fn(Team $team) => TeamResource::make($team)),
            'totals' => $this->resource->total(),
            'per_page' => $this->resource->perPage(),
            'current_page' => $this->resource->currentPage(),
        ];
    }
}

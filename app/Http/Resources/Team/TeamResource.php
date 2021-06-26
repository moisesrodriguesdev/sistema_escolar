<?php

namespace App\Http\Resources\Team;

use App\Models\Team;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var Team $this */
        return [
            'year' => $this->year,
            'teach_level' => $this->teach_level,
            'serie' => $this->serie,
            'shift' => $this->shift,
            'created_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}

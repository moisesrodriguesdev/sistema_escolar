<?php

namespace App\Http\Resources\School;

use App\Http\Resources\Team\TeamResource;
use App\Models\Team;
use Illuminate\Http\Resources\Json\JsonResource;
use \App\Models\School;

class SchoolResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var School $this */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'teams' => $this->teams()->get()->transform(fn (Team $team) => TeamResource::make($team)),
            'created_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}

<?php

namespace App\Http\Resources\Student;

use App\Http\Resources\Team\TeamResource;
use App\Models\Team;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var \App\Models\Student $this */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'cellphone' => $this->cellphone,
            'email' => $this->email,
            'birth' => optional($this->birth)->format('Y-m-d'),
            'gender' => $this->gender,
            'teams' => $this->teams()->get()->transform(fn(Team $team) => TeamResource::make($team))
        ];
    }
}

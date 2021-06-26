<?php

namespace App\Http\Resources\School;

use App\Models\School;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SchoolsCollection extends ResourceCollection
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
            'items' => $this->collection->transform(fn(School $school) => SchoolResource::make($school)),
            'totals' => $this->resource->total(),
            'per_page' => $this->resource->perPage(),
            'current_page' => $this->resource->currentPage(),
        ];
    }
}

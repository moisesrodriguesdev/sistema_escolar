<?php

namespace App\Http\Resources\Student;

use App\Models\Student;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StudentsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'items' => $this->collection->transform(fn(Student $student) => StudentResource::make($student)),
            'totals' => $this->resource->total(),
            'per_page' => $this->resource->perPage(),
            'current_page' => $this->resource->currentPage(),
        ];
    }
}

<?php


namespace App\Repositories;


use App\Contracts\SchoolRepositoryContract;
use App\Models\School;

class SchoolRepository implements SchoolRepositoryContract
{
    private School $school;

    public function __construct(School $school)
    {
        $this->school = $school;
    }

    public function getAll(array $filters)
    {
        // TODO: Implement getAll() method.
    }
}

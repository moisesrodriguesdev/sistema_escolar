<?php

namespace App\Repositories;

use App\Contracts\StudentRepositoryContract;
use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;

class StudentRepository implements StudentRepositoryContract
{
    private Student $student;

    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    public function getAll(array $filters = null): Collection
    {
        return $this->student->all();
    }
}

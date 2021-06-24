<?php

namespace App\Repositories;

use App\Contracts\StudentRepositoryContract;
use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class StudentRepository implements StudentRepositoryContract
{
    /** @var Student|Builder  */
    private Student $student;

    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    /**
     * @param array|null $filters
     * @return LengthAwarePaginator
     */
    public function getAll(array $filters = null): LengthAwarePaginator
    {
        return $this->student
            ->when(isset($filters['name']), fn (Builder $query) => $query->where('name', 'like', "%{$filters['name']}%"))
            ->paginate(5);
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->student->create($data);
    }

    /**
     * @param int $id
     * @return Model
     */
    public function findById(int $id): Model
    {
        return $this->student->findOrFail($id);
    }
}

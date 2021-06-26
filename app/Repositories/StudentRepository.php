<?php

namespace App\Repositories;

use App\Contracts\StudentRepositoryContract;
use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class StudentRepository implements StudentRepositoryContract
{
    /** @var Student|Builder */
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
            ->when(isset($filters['name']), fn(Builder $query) => $query->where('name', 'like', "%{$filters['name']}%"))
            ->paginate(5);
    }

    /**
     * @param int $id
     * @return Model
     */
    public function findById(int $id): Model
    {
        return $this->student->findOrFail($id);
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        /** @var Student $student */
        $studentCreated = $this->student->create($data);
        if (isset($data['team_id'])) {
            $studentCreated->teams()->attach($data['team_id']);
        }
        return $studentCreated;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param array $data
     * @return bool
     */
    public function update(Model $model, array $data): bool
    {
        return $model->update($data);
    }

    /**
     * @param Model $model
     * @return bool|null
     */
    public function delete(Model $model): ?bool
    {
        /** @var Student $model */
        $model->teams()->detach();
        return $model->delete();
    }
}

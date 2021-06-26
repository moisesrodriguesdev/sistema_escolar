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
     * @param string $orderBy
     * @param string $order
     * @param int $currentPage
     * @param int $perPage
     * @param array|null $filters
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAll(string $orderBy, string $order, int $currentPage, int $perPage, array $filters = null): LengthAwarePaginator
    {
        /** @var Builder $students */
        $students =  $this->student
            ->when(isset($filters['name']), fn(Builder $query) => $query->where('name', 'like', "%{$filters['name']}%"))
            ->orderBy($orderBy, $order);

            return $students->paginate($perPage, ['*'], 'page', $currentPage);
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
     * @param Model $model
     * @param array $data
     * @return bool|Model
     */
    public function update(Model $model, array $data): Model
    {
        $model->update($data);
        return $model->refresh();
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

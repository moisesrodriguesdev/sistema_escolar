<?php

namespace App\Repositories;

use App\Contracts\SchoolRepositoryContract;
use App\Models\School;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SchoolRepository implements SchoolRepositoryContract
{
    /** @var School|Builder */
    private School $school;

    public function __construct(School $school)
    {
        $this->school = $school;
    }

    /**
     * @param array|null $filters
     * @return LengthAwarePaginator
     */
    public function getAll(array $filters = null): LengthAwarePaginator
    {
        return $this->school
            ->when(isset($filters['name']), fn(Builder $query) => $query->where('name', 'like', "%{$filters['name']}%"))
            ->paginate(5);
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->school->create($data);
    }

    /**
     * @param Model $model
     * @param array $data
     * @return bool
     */
    public function update(Model $model, array $data): bool
    {
        return $model->update($data);
    }

    /**
     * @param int $id
     * @return Model
     */
    public function findById(int $id): Model
    {
        return $this->school->findOrFail($id);
    }

    /**
     * @param Model $model
     * @return bool|null
     */
    public function delete(Model $model): ?bool
    {
        /** @var School $model */
        $model->teams()->delete();
        return $model->delete();
    }
}

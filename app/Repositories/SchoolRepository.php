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
     * @param string $orderBy
     * @param string $order
     * @param int $currentPage
     * @param int $perPage
     * @param array|null $filters
     * @return LengthAwarePaginator
     */
    public function getAll(string $orderBy, string $order, int $currentPage, int $perPage, array $filters = null): LengthAwarePaginator
    {
        /** @var Builder $schools */
        $schools = $this->school
            ->when(isset($filters['name']), fn(Builder $query) => $query->where('name', 'like', "%{$filters['name']}%"))
            ->orderBy($orderBy, $order);

        return $schools->paginate($perPage, ['*'], 'page', $currentPage);
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
     * @return bool|\Illuminate\Database\Eloquent\Model
     */
    public function update(Model $model, array $data): Model
    {
        $model->update($data);
        return $model->refresh();
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

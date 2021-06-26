<?php


namespace App\Repositories;


use App\Contracts\SchoolRepositoryContract;
use App\Models\School;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SchoolRepository implements SchoolRepositoryContract
{
    /** @var School|Builder */
    private School $school;

    public function __construct(School $school)
    {
        $this->school = $school;
    }

    public function getAll(array $filters = null): LengthAwarePaginator
    {
        return $this->school->paginate();
    }

    public function create(array $data): Model
    {
        // TODO: Implement create() method.
    }

    public function update(Model $model, array $data): bool
    {
        // TODO: Implement update() method.
    }

    public function findById(int $id): Model
    {
        // TODO: Implement findById() method.
    }

    public function delete(Model $model): ?bool
    {
        // TODO: Implement delete() method.
    }
}

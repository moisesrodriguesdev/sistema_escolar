<?php

namespace App\Repositories;

use App\Contracts\TeamRepositoryContract;
use App\Models\Team;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TeamRepository implements TeamRepositoryContract
{
    /** @var Team|Builder */
    private Team $team;

    public function __construct(Team $team)
    {
        $this->team = $team;
    }

    /**
     * @param int $id
     * @return Model
     */
    public function findById(int $id): Model
    {
        return $this->team->findOrFail($id);
    }

    /**
     * @param array|null $filters
     * @return LengthAwarePaginator
     */
    public function getAll(array $filters = null): LengthAwarePaginator
    {
        return $this->team
            ->when(isset($filters['serie']), fn(Builder $query) => $query->where('serie', $filters['serie']))
            ->paginate(5);
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->team->create($data);
    }

    /**
     * @param Model $model
     * @param array $data
     * @return bool
     */
    public function update(Model $model, array $data): bool
    {
        /** @var Team $model */
        $model->update($data);
        if (isset($data['students'])) {
            $model->students()->attach($data['students']);
        }

        return true;
    }

    /**
     * @param Model $model
     * @return bool|null
     */
    public function delete(Model $model): ?bool
    {
        /** @var Team $model */
        $model->students()->detach();
        return $model->delete();
    }

}

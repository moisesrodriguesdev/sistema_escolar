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
     * @param string $orderBy
     * @param string $order
     * @param int $currentPage
     * @param int $perPage
     * @param array|null $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll(string $orderBy, string $order, int $currentPage, int $perPage, array $filters = null): LengthAwarePaginator
    {
        /** @var Builder $teams */
        $teams = $this->team
            ->when(isset($filters['serie']), fn(Builder $query) => $query->where('serie', $filters['serie']))
            ->orderBy($orderBy, $order);

        return $teams->paginate($perPage, ['*'], 'page', $currentPage);
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
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(Model $model, array $data): Model
    {
        /** @var Team $model */
        $model->update($data);
        if (isset($data['students'])) {
            $model->students()->attach($data['students']);
        }

        return $model;
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

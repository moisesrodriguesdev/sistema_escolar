<?php


namespace App\Repositories;


use App\Contracts\TeamRepositoryContract;
use App\Models\Team;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
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
     * @param int $id
     * @return Model
     */
    public function findById(int $id): Model
    {
        return $this->team->findOrFail($id);
    }
}

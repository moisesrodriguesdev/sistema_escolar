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

    public function getAll(array $filters = null): LengthAwarePaginator
    {
        return $this->team->paginate();
    }

    public function create(array $data): Model
    {
        // TODO: Implement create() method.
    }

    public function findById(int $id): Model
    {
        // TODO: Implement findById() method.
    }
}

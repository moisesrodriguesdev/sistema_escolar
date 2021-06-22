<?php


namespace App\Repositories;


use App\Contracts\TeamRepositoryContract;
use App\Models\Team;

class TeamRepository implements TeamRepositoryContract
{
    private Team $team;

    public function __construct(Team $team)
    {
        $this->team = $team;
    }

    public function getAll(array $filters)
    {
        // TODO: Implement getAll() method.
    }
}

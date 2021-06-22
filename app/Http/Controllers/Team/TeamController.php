<?php

namespace App\Http\Controllers\Team;

use App\Contracts\TeamRepositoryContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    private TeamRepositoryContract $repository;

    public function __construct(TeamRepositoryContract $repository)
    {
        $this->repository = $repository;
    }
}

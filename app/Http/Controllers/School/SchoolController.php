<?php

namespace App\Http\Controllers\School;

use App\Contracts\SchoolRepositoryContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    private SchoolRepositoryContract $repository;

    public function __construct(SchoolRepositoryContract $repository)
    {
        $this->repository = $repository;
    }
}

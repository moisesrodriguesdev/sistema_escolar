<?php

namespace App\Http\Controllers\Student;

use App\Contracts\StudentRepositoryContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private StudentRepositoryContract $repository;

    public function __construct(StudentRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        dd('oi');
    }

}

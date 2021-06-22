<?php

namespace App\Http\Controllers\Student;

use App\Contracts\StudentRepositoryContract;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    private StudentRepositoryContract $repository;

    public function __construct(StudentRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return view('student.home', ['students' => $this->repository->getAll()]);
    }

}

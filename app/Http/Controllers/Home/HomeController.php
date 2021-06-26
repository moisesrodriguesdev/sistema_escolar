<?php

namespace App\Http\Controllers\Home;

use App\Contracts\SchoolRepositoryContract;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    private SchoolRepositoryContract $schoolRepository;

    public function __construct(SchoolRepositoryContract $schoolRepository)
    {
        $this->schoolRepository = $schoolRepository;
    }

    public function index()
    {
        return view('school.home', ['schools' => $this->schoolRepository->getAll()]);
    }
}

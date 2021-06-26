<?php

namespace App\Http\Controllers\Home;

use App\Contracts\SchoolRepositoryContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private SchoolRepositoryContract $schoolRepository;

    public function __construct(SchoolRepositoryContract $schoolRepository)
    {
        $this->schoolRepository = $schoolRepository;
    }

    public function index(Request $request)
    {
        return view(
            'school.home',
            [
                'schools' => $this->schoolRepository->getAll(
                    $request->input('order_by', 'id'),
                    $request->input('order', 'ASC'),
                    (int)$request->input('page', 1),
                    (int)$request->input('per_page', 40)
                )
            ]
        );
    }
}

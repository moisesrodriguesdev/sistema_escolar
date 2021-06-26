<?php

namespace App\Http\Controllers\Api\Student;

use App\Contracts\StudentRepositoryContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Student\ListStudentsRequest;
use App\Http\Resources\Student\StudentsCollection;
use App\Traits\Rest\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class StudentController extends Controller
{
    use ApiResponse;

    private StudentRepositoryContract $studentRepository;

    public function __construct(StudentRepositoryContract $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    /**
     * @param \App\Http\Requests\Student\ListStudentsRequest $request
     * @return JsonResponse
     */
    public function index(ListStudentsRequest $request): JsonResponse
    {
        return $this->successApiResponse(
            StudentsCollection::make(
                $this->studentRepository->getAll(
                    $request->input('order_by', 'id'),
                    $request->input('order', 'ASC'),
                    (int)$request->input('page', 1),
                    (int)$request->input('per_page', 5)
                )
            )->resolve()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

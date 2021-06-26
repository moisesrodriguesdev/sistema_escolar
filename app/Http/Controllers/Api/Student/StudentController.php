<?php

namespace App\Http\Controllers\Api\Student;

use App\Contracts\StudentRepositoryContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Student\CreateStudentRequest;
use App\Http\Requests\Student\ListStudentsRequest;
use App\Http\Resources\Student\StudentResource;
use App\Http\Resources\Student\StudentsCollection;
use App\Traits\Rest\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
     * @param CreateStudentRequest $request
     * @return JsonResponse
     */
    public function store(CreateStudentRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $studentCreated = $this->studentRepository->create($request->post());
            DB::commit();

            return $this->createdApiResponse(StudentResource::make($studentCreated)->resolve());
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorApiResponse(['message' => 'Erro interno no servidor']);
        }
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
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $student = $this->studentRepository->findById($id);
            $this->studentRepository->delete($student);

            return $this->okApiResponse([], 'Aluno deletado com sucesso');
        } catch (ModelNotFoundException $notFoundException) {
            return $this->notFoundApiResponse(['message' => 'Aluno inválida']);
        } catch (\Exception $e) {
            return $this->errorApiResponse(['message' => 'Erro interno no servidor']);
        }
    }
}

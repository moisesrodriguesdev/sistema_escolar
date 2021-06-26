<?php

namespace App\Http\Controllers\Api\School;

use App\Contracts\SchoolRepositoryContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\School\CreateSchoolRequest;
use App\Http\Requests\School\ListSchoolsRequest;
use App\Http\Requests\School\UpdateSchoolRequest;
use App\Http\Resources\School\SchoolResource;
use App\Http\Resources\School\SchoolsCollection;
use App\Traits\Rest\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    use ApiResponse;

    private SchoolRepositoryContract $schoolRepository;

    public function __construct(SchoolRepositoryContract $schoolRepository)
    {
        $this->schoolRepository = $schoolRepository;
    }

    public function index(ListSchoolsRequest $request): JsonResponse
    {
        return $this->successApiResponse(
            SchoolsCollection::make(
                $this->schoolRepository->getAll(
                    $request->input('order_by', 'id'),
                    $request->input('order', 'ASC'),
                    (int)$request->input('page', 1),
                    (int)$request->input('per_page', 40)
                )
            )->resolve()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateSchoolRequest $request
     * @return JsonResponse
     */
    public function store(CreateSchoolRequest $request): JsonResponse
    {
        try {
            /** @var \App\Models\School $schoolCreated */
            $schoolCreated = $this->schoolRepository->create($request->post());

            return $this->createdApiResponse(SchoolResource::make($schoolCreated)->resolve());
        } catch (ModelNotFoundException $notFoundException) {
            return $this->notFoundApiResponse(['message' => 'Escola inválida']);
        } catch (\Exception $e) {
            return $this->errorApiResponse(['message' => 'Erro interno no servidor']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        /** @var \App\Models\School $school */
        $school = $this->schoolRepository->findById($id);

        return $this->successApiResponse(SchoolResource::make($school)->resolve());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSchoolRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateSchoolRequest $request, $id): JsonResponse
    {
        try {
            $school = $this->schoolRepository->findById($id);

            return $this->successApiResponse(SchoolResource::make($this->schoolRepository->update($school, $request->post()))->resolve());
        } catch (ModelNotFoundException $notFoundException) {
            return $this->notFoundApiResponse(['message' => 'Escola inválida']);
        } catch (\Exception $e) {
            return $this->errorApiResponse(['message' => 'Erro interno no servidor']);
        }
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
            $school = $this->schoolRepository->findById($id);
            $this->schoolRepository->delete($school);

            return $this->okApiResponse([], 'Escola deletada com sucesso');
        } catch (ModelNotFoundException $notFoundException) {
            return $this->notFoundApiResponse(['message' => 'Escola inválida']);
        } catch (\Exception $e) {
            return $this->errorApiResponse(['message' => 'Erro interno no servidor']);
        }
    }
}

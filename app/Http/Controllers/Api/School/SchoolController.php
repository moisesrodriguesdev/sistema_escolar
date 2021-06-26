<?php

namespace App\Http\Controllers\Api\School;

use App\Contracts\SchoolRepositoryContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\School\CreateSchoolRequest;
use App\Http\Requests\School\ListSchoolsRequest;
use App\Http\Resources\School\SchoolResource;
use App\Http\Resources\School\SchoolsCollection;
use App\Traits\Rest\ApiResponse;
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
        /** @var \App\Models\School $schoolCreated */
        $schoolCreated = $this->schoolRepository->create($request->post());

        return $this->createdApiResponse(SchoolResource::make($schoolCreated)->resolve());
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

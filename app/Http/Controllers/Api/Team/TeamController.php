<?php

namespace App\Http\Controllers\Api\Team;

use App\Contracts\TeamRepositoryContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Team\CreateTeamRequest;
use App\Http\Requests\Team\ListTeamsRequest;
use App\Http\Resources\Team\TeamResource;
use App\Http\Resources\Team\TeamsCollection;
use App\Traits\Rest\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    use ApiResponse;

    private TeamRepositoryContract $teamRepository;

    public function __construct(TeamRepositoryContract $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    /**
     * @param ListTeamsRequest $request
     * @return JsonResponse
     */
    public function index(ListTeamsRequest $request): JsonResponse
    {
        return $this->successApiResponse(
            TeamsCollection::make(
                $this->teamRepository->getAll(
                    $request->input('order_by', 'id'),
                    $request->input('order', 'ASC'),
                    (int)$request->input('page', 1),
                    (int)$request->input('per_page', 5)
                )
            )->resolve()
        );
    }

    /**
     * @param CreateTeamRequest $request
     * @return JsonResponse
     */
    public function store(CreateTeamRequest $request): JsonResponse
    {
        $teamCreated = $this->teamRepository->create($request->post());

        return $this->createdApiResponse(TeamResource::make($teamCreated)->resolve());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $student = $this->teamRepository->findById($id);

            return $this->successApiResponse(TeamResource::make($student)->resolve());
        } catch (ModelNotFoundException $notFoundException) {
            return $this->notFoundApiResponse(['message' => 'Turma inválida']);
        } catch (\Exception $e) {
            return $this->errorApiResponse(['message' => 'Erro interno no servidor']);
        }
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
            $student = $this->teamRepository->findById($id);
            $this->teamRepository->delete($student);

            return $this->okApiResponse([], 'Turma excluída com sucesso');
        } catch (ModelNotFoundException $notFoundException) {
            return $this->notFoundApiResponse(['message' => 'Turma inválida']);
        } catch (\Exception $e) {
            return $this->errorApiResponse(['message' => 'Erro interno no servidor']);
        }
    }
}

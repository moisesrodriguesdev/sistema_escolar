<?php

namespace App\Http\Controllers\Team;

use App\Contracts\SchoolRepositoryContract;
use App\Contracts\StudentRepositoryContract;
use App\Contracts\TeamRepositoryContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Team\CreateTeamRequest;
use App\Http\Requests\Team\UpdateTeamRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use \Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    private TeamRepositoryContract $repository;
    private SchoolRepositoryContract $schoolRepository;
    private StudentRepositoryContract $studentRepository;

    public function __construct(TeamRepositoryContract $repository, SchoolRepositoryContract $schoolRepositoryContract, StudentRepositoryContract $studentRepository)
    {
        $this->repository = $repository;
        $this->schoolRepository = $schoolRepositoryContract;
        $this->studentRepository = $studentRepository;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        return view('teams.home', ['teams' => $this->repository->getAll($request->all())]);
    }

    /**
     * @param int $team
     * @return Application|Factory|View|RedirectResponse
     */
    public function show(int $team)
    {
        try {
            return view('teams.show', ['team' => $this->repository->findById($team)]);
        } catch (ModelNotFoundException $notFoundException) {
            return redirect()->back()->with(['message' => 'Turma inválida', 'alert' => 'danger']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => 'Erro ao retornar turma', 'alert' => 'danger']);
        }
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('teams.create', ['schools' => $this->schoolRepository->getAll()]);
    }

    /**
     * @param CreateTeamRequest $request
     * @return RedirectResponse
     */
    public function store(CreateTeamRequest $request): RedirectResponse
    {
        try {
            $this->repository->create($request->post());

            return redirect()->route('teams.index')->with(
                ['message' => 'Escola cadastrado com sucesso', 'alert' => 'success']
            );
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => 'Erro ao cadastrar turma', 'alert' => 'danger']);
        }
    }

    /**
     * @param int $team
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit(int $team)
    {
        try {
            return view(
                'teams.edit',
                [
                    'team' => $this->repository->findById($team),
                    'schools' => $this->schoolRepository->getAll(),
                    'students' => $this->studentRepository->getAll()
                ]
            );
        } catch (ModelNotFoundException $notFoundException) {
            return redirect()->back()->with(['message' => 'Estudante inválido', 'alert' => 'danger']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => 'Erro ao retornar estudante', 'alert' => 'danger']);
        }
    }

    /**
     * @param UpdateTeamRequest $request
     * @param int $team
     * @return RedirectResponse
     */
    public function update(UpdateTeamRequest $request, int $team): RedirectResponse
    {
        try {
            /** @var \App\Models\Team $teamInstance */
            $teamInstance = $this->repository->findById($team);
            $this->repository->update($teamInstance, $request->post());

            return redirect()->route('teams.index')->with(['message' => 'Turma atualizada com sucesso', 'alert' => 'success']);
        } catch (ModelNotFoundException $notFoundException) {
            return redirect()->back()->with(['message' => 'Estudante inválido', 'alert' => 'danger']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => 'Erro ao retornar estudante', 'alert' => 'danger']);
        }
    }

    /**
     * @param int $team
     * @return RedirectResponse
     */
    public function destroy(int $team): RedirectResponse
    {
        try {
            DB::beginTransaction();
            /** @var \App\Models\Team $teamInstance */
            $teamInstance = $this->repository->findById($team);
            $this->repository->delete($teamInstance);

            DB::commit();
            return redirect()->route('teams.index')->with(['message' => 'Turma deletado com sucesso', 'alert' => 'success']);
        } catch (ModelNotFoundException $notFoundException) {
            return redirect()->back()->with(['message' => 'Turma inválido', 'alert' => 'danger']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['message' => $e->getMessage(), 'alert' => 'danger']);
        }
    }
}

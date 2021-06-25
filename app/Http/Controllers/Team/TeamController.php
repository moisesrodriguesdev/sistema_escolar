<?php

namespace App\Http\Controllers\Team;

use App\Contracts\SchoolRepositoryContract;
use App\Contracts\TeamRepositoryContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Team\CreateTeamRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use \Illuminate\Http\RedirectResponse;

class TeamController extends Controller
{
    private TeamRepositoryContract $repository;
    private SchoolRepositoryContract $schoolRepository;

    public function __construct(TeamRepositoryContract $repository, SchoolRepositoryContract $schoolRepositoryContract)
    {
        $this->repository = $repository;
        $this->schoolRepository = $schoolRepositoryContract;
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

            return redirect()->route('teams.index')->with(['message' => 'Escola cadastrado com sucesso', 'alert' => 'success']);
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
                    'teams' => $this->repository->findById($team),
                    'schools' => $this->repository->getAll()
                ]
            );
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
            $team = $this->repository->findById($team);
            $team->delete();

            return redirect()->route('teams.index')->with(['message' => 'Turma deletado com sucesso', 'alert' => 'success']);
        } catch (ModelNotFoundException $notFoundException) {
            return redirect()->back()->with(['message' => 'Turma inválido', 'alert' => 'danger']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => 'Erro ao cadastrar turma', 'alert' => 'danger']);
        }
    }
}

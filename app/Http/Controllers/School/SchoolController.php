<?php

namespace App\Http\Controllers\School;

use App\Contracts\SchoolRepositoryContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\School\CreateSchoolRequest;
use App\Http\Requests\School\UpdateSchoolRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    private SchoolRepositoryContract $repository;

    public function __construct(SchoolRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        return view('school.home', ['schools' => $this->repository->getAll($request->post())]);
    }

    /**
     * @param int $school
     * @return Application|Factory|View|RedirectResponse
     */
    public function show(int $school)
    {
        try {
            return view('school.show', ['school' => $this->repository->findById($school)]);
        } catch (ModelNotFoundException $notFoundException) {
            return redirect()->back()->with(['message' => 'Escola inválida', 'alert' => 'danger']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage(), 'alert' => 'danger']);
        }
    }

    public function create()
    {
        return view('school.create');
    }

    public function store(CreateSchoolRequest $request): RedirectResponse
    {
        try {
            $this->repository->create($request->post());

            return redirect()->route('schools.index')->with(['message' => 'Escola cadastrado com sucesso', 'alert' => 'success']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => 'Erro ao cadastrar escola', 'alert' => 'danger']);
        }
    }

    /**
     * @param int $student
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit(int $student)
    {
        try {
            return view(
                'school.edit',
                [
                    'school' => $this->repository->findById($student)
                ]
            );
        } catch (ModelNotFoundException $notFoundException) {
            return redirect()->back()->with(['message' => 'Escola inválida', 'alert' => 'danger']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => 'Erro ao retornar escola', 'alert' => 'danger']);
        }
    }

    /**
     * @param UpdateSchoolRequest $request
     * @param int $school
     * @return RedirectResponse
     */
    public function update(UpdateSchoolRequest $request, int $school): RedirectResponse
    {
        try {
            $studentInstance = $this->repository->findById($school);
            $this->repository->update($studentInstance, $request->post());

            return redirect()->route('schools.index')->with(['message' => 'Escola atualizado com sucesso', 'alert' => 'success']);
        } catch (ModelNotFoundException $notFoundException) {
            return redirect()->back()->with(['message' => 'Escola inválido', 'alert' => 'danger']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => 'Erro ao retornar escola', 'alert' => 'danger']);
        }
    }

    /**
     * @param int $school
     * @return RedirectResponse
     */
    public function destroy(int $school): RedirectResponse
    {
        try {
            $schoolInstance = $this->repository->findById($school);
            $this->repository->delete($schoolInstance);

            return redirect()->route('schools.index')->with(['message' => 'Escola excluída com sucesso', 'alert' => 'success']);
        } catch (ModelNotFoundException $notFoundException) {
            return redirect()->back()->with(['message' => 'Escola inválida', 'alert' => 'danger']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => 'Erro ao excluir escola', 'alert' => 'danger']);
        }
    }
}

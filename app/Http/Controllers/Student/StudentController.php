<?php

namespace App\Http\Controllers\Student;

use App\Contracts\StudentRepositoryContract;
use App\Contracts\TeamRepositoryContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Student\CreateStudentRequest;
use App\Http\Requests\Student\UpdateStudentRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private StudentRepositoryContract $studentRepository;
    private TeamRepositoryContract $teamRepository;

    public function __construct(StudentRepositoryContract $studentRepository, TeamRepositoryContract $teamRepository)
    {
        $this->studentRepository = $studentRepository;
        $this->teamRepository = $teamRepository;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        return view('student.home', ['students' => $this->studentRepository->getAll($request->all())]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('student.create', ['teams' => $this->teamRepository->getAll()]);
    }

    /**
     * @param CreateStudentRequest $request
     * @return RedirectResponse
     */
    public function store(CreateStudentRequest $request): RedirectResponse
    {
        try {
            $this->studentRepository->create($request->post());

            return redirect()->route('students.index')->with(['message' => 'Estudante cadastrado com sucesso', 'alert' => 'success']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => 'Erro ao cadastrar estudante', 'alert' => 'danger']);
        }
    }

    public function show(int $student)
    {
        try {
            return view('student.show', ['student' => $this->studentRepository->findById($student)]);
        } catch (ModelNotFoundException $notFoundException) {
            return redirect()->back()->with(['message' => 'Estudante inválido', 'alert' => 'danger']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => 'Erro ao retornar estudante', 'alert' => 'danger']);
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
                'student.edit',
                [
                    'student' => $this->studentRepository->findById($student),
                    'teams' => $this->teamRepository->getAll()
                ]
            );
        } catch (ModelNotFoundException $notFoundException) {
            return redirect()->back()->with(['message' => 'Estudante inválido', 'alert' => 'danger']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => 'Erro ao retornar estudante', 'alert' => 'danger']);
        }
    }

    /**
     * @param UpdateStudentRequest $request
     * @param int $student
     * @return RedirectResponse
     */
    public function update(UpdateStudentRequest $request, int $student): RedirectResponse
    {
        try {
            $studentInstance = $this->studentRepository->findById($student);
            $this->studentRepository->update($studentInstance, $request->post());

            return redirect()->route('students.index')->with(['message' => 'Estudante atualizado com sucesso', 'alert' => 'success']);
        } catch (ModelNotFoundException $notFoundException) {
            return redirect()->back()->with(['message' => 'Estudante inválido', 'alert' => 'danger']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => 'Erro ao retornar estudante', 'alert' => 'danger']);
        }
    }

    /**
     * @param int $student
     * @return RedirectResponse
     */
    public function destroy(int $student): RedirectResponse
    {
        try {
            /** @var \App\Models\Student $studentInstance */
            $studentInstance = $this->studentRepository->findById($student);
            $this->studentRepository->delete($studentInstance);

            return redirect()->route('students.index')->with(['message' => 'Estudante deletado com sucesso', 'alert' => 'success']);
        } catch (ModelNotFoundException $notFoundException) {
            return redirect()->back()->with(['message' => 'Estudante inválido', 'alert' => 'danger']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => 'Erro ao excluir estudante', 'alert' => 'danger']);
        }
    }

}

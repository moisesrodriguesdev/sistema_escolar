@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center" style="background: #44494D; color:white;">Atualizar turma</div>
                <div class="card-body">
                    <form action="{{ route('teams.update', $team->id) }}" method="post">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @csrf
                        @method('PUT')
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <label for="role">Ano</label>
                                <input type="text" class="form-control" id="year" name="year" value="{{ $team->year }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <label for="role">Nível de ensino</label>
                                <input type="text" class="form-control" id="teach_level" name="teach_level"
                                       value="{{ $team->teach_level }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <label for="role">Serie</label>
                                <input type="text" class="form-control" id="serie" name="serie"
                                       value="{{ $team->serie }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <label for="role">Turno</label>
                                <input type="text" class="form-control" id="shift" name="shift"
                                       value="{{ $team->shift }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <label for="role">Selecione a escola</label>
                                <select class="form-control" id="schools" name="school_id">
                                    <option></option>
                                    @foreach($schools->items() as $school)
                                        <option
                                            value="{{ $school->id}}" {{ $school->id === $team->school_id ? 'selected' : ''}}>{{ $school->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label for="role">Insira alunos na turma</label>
                                    @forelse($students as $student)
                                        <div>
                                            <input type="checkbox" id="students_{{ $student->id }}" value="{{ $student->id }}" name="students[]">
                                            <label for="students_{{ $student->id }}">{{ $student->name }}</label>
                                        </div>
                                    @empty
                                        <p>Não há alunos cadastrados.</p>
                                    @endforelse
                                </div>
                            </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('teams.index') }}">
                        <button class="btn btn-primary" type="button"><i class="fas fa-arrow-left"></i> Voltar</button>
                    </a>
                    <button class="btn btn-success" type="submit"><i class="fas fa-save"></i> Salvar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@extends('layout.master')
@section('content')
    @section('titulo','Visualizar turma')
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center" style="background: #44494D; color:white;">Detalhes da Turma</div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label for="role">Ano:</label>
                            <p>{{ $team->year }}</p>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label for="role">Nível de ensino:</label>
                            <p>{{ $team->teach_level }}</p>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label for="role">Serie:</label>
                            <p>{{ $team->serie }}</p>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label for="role">Turno:</label>
                            <p>{{ $team->shift }}</p>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label for="role">Selecione a escola:</label>
                            <p>{{ $team->school->name }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3 align="center" class="pt-3">Alunos dessa turma</h3>
                            @forelse($team->students as $student)
                                <p>Nome: {{ $student->name }}</p>
                                <p>Telefone: {{ $student->cellphone ?? 'Não há telefone cadastrado' }}</p>
                                <p>Email: {{ $student->email }}</p>
                                <p>Data de nascimento: {{ optional($student->birth)->format('d/m/Y') }}</p>
                                <p>Sexo: {{ $student->gender ?? 'Não há sexo cadastrado.' }}</p>
                                <hr>
                            @empty
                                <h5>Não há alunos cadastrado para essa turma.</h5>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('teams.index') }}">
                        <button class="btn btn-primary" type="button"><i class="fas fa-arrow-left"></i> Voltar</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection

@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center" style="background: #44494D; color:white;">Atualizar aluno</div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label for="role">Nome:</label>
                            <p>{{ $student->name }}</p>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label for="role">Telefone:</label>
                            <p>{{ $student->cellphone ?? 'Telefone não cadastrado'}}</p>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label for="role">Email:</label>
                            <p>{{ $student->email }}</p>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label for="role">Data de nascimento:</label>
                            <p>{{ optional($student->birth)->format('d/m/Y') ?? 'Data de nascimento não cadastrado'}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3 align="center" class="pt-3">Turmas do estudante</h3>
                            @forelse($student->teams as $team)
                                <p>Turno: {{ $team->shift }}</p>
                                <p>Nível de ensino: {{ $team->teach_level }}</p>
                                <p>Série: {{ $team->serie }}</p>
                                <p>Ano: {{ $team->year }}</p>
                                <p>Escola: {{ $team->school->name }}</p>
                                <hr>
                            @empty
                                <h5>Não há turmas cadastradas para esse estudante.</h5>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('students.index') }}">
                        <button class="btn btn-primary"><i class="fas fa-arrow-left"></i> Voltar</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

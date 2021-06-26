@extends('layout.master')
@section('content')
    @section('titulo','Visualizar escola')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center" style="background: #44494D; color:white;">Detalhes da escola</div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label for="role">Nome:</label>
                            <p>{{ $school->name }}</p>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label for="role">Endereço:</label>
                            <p>{{ $school->address}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3 align="center" class="pt-3">Turmas da escola</h3>
                            @forelse($school->teams as $team)
                                <p>Turno: {{ $team->shift }}</p>
                                <p>Nível de ensino: {{ $team->teach_level }}</p>
                                <p>Série: {{ $team->serie }}</p>
                                <p>Ano: {{ $team->year }}</p>
                                <p>Escola: {{ $team->school->name }}</p>
                                <hr>
                            @empty
                                <h5>Não há turmas cadastradas para essa escola.</h5>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('schools.index') }}">
                        <button class="btn btn-primary"><i class="fas fa-arrow-left"></i> Voltar</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

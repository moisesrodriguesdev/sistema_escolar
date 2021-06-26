@extends('layout.master')
@section('content')
    <div class="table-responsive mt-3 p-2">
        @if(session()->has('message'))
            <div class="alert alert-{{ session()->get('alert') }}" role="alert">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('teams.create') }}">
                <button class="btn btn-primary">Cadastrar turma</button>
            </a>
            <form action="{{ route('teams.index') }}" method="GET" class="d-flex">
                <input type="text" name="serie" id="serie" class="form-control" value="{{ request()->input('serie') }}"
                       placeholder="Pesquise pela serie">
                <button type="submit" class="btn btn-primary ml-2 d-flex flex-row">
                    <i class="fas fa-search p-lg-1"></i>
                    Pesquisar
                </button>
            </form>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Ano</th>
                <th scope="col">Nivel de ensino</th>
                <th scope="col">Série</th>
                <th scope="col">Turno</th>
                <th scope="col">Escola</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($teams as $team)
                <tr>
                    <th scope="row">{{ $team->id }}</th>
                    <td>{{ $team->year }}</td>
                    <td>{{ $team->teach_level }}</td>
                    <td>{{ $team->serie }}</td>
                    <td>{{ $team->shift }}</td>
                    <td>{{ $team->school->name }}</td>
                    <td align="center">
                        <form action="{{ route('teams.destroy', $team->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                    <td align="center">
                        <a href="{{ route('teams.edit', $team->id) }}">
                            <button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                        </a>
                    </td>
                    <td align="center">
                        <a href="{{ route('teams.show', $team->id) }}">
                            <button class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i></button>
                        </a>
                    </td>
                </tr>
            @empty
                <p>Não há turma cadastrados.</p>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $teams->links() }}
    </div>

@endsection

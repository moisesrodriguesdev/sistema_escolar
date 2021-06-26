@extends('layout.master')
@section('content')
    @section('titulo','Escolas')
    <div class="table-responsive mt-3 p-2">
        @if(session()->has('message'))
            <div class="alert alert-{{ session()->get('alert') }}" role="alert">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('schools.create') }}">
                <button class="btn btn-primary">Cadastrar escola</button>
            </a>
            <form action="{{ route('schools.index') }}" method="GET" class="d-flex">
                <input type="text" name="name" id="name" class="form-control" value="{{ request()->input('name') }}"
                       placeholder="Nome do escola">
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
                <th scope="col">Nome</th>
                <th scope="col">Endereço</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($schools as $school)
                <tr>
                    <th scope="row">{{ $school->id }}</th>
                    <td>{{ $school->name }}</td>
                    <td>{{ $school->address }}</td>
                    <td align="center">
                        <form action="{{ route('schools.destroy', $school->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                    <td align="center">
                        <a href="{{ route('schools.edit', $school->id) }}">
                            <button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                        </a>
                    </td>
                    <td align="center">
                        <a href="{{ route('schools.show', $school->id) }}">
                            <button class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i></button>
                        </a>
                    </td>
                </tr>
            @empty
                <p>Não há escolas cadastrados.</p>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $schools->links() }}
    </div>
@endsection

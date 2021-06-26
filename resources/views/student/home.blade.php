@extends('layout.master')
@section('content')

    @if(session()->has('message'))
        <div class="alert alert-{{ session()->get('alert') }}" role="alert">
            {{ session()->get('message') }}
        </div>
    @endif


    <div class="table-responsive mt-3 p-2">
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('students.create') }}">
                <button class="btn btn-primary">Cadastrar estudante</button>
            </a>
            <form action="{{ route('students.index') }}" method="GET" class="d-flex">
                <input type="text" name="name" id="name" class="form-control" value="{{ request()->input('name') }}" placeholder="Nome do aluno">
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
                <th scope="col">Telefone</th>
                <th scope="col">Email</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($students as $student)
                <tr>
                    <th scope="row">{{ $student->id }}</th>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->cellphone }}</td>
                    <td>{{ $student->email }}</td>
                    <td align="center">
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                    <td align="center">
                        <a href="{{ route('students.edit', $student->id) }}">
                            <button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                        </a>
                    </td>
                    <td align="center">
                        <a href="{{ route('students.show', $student->id) }}">
                            <button class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i></button>
                        </a>
                    </td>
                </tr>
            @empty
                <p>Não há estudantes cadastrados.</p>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $students->links() }}
    </div>
@endsection

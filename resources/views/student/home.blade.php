@extends('layout.master')
@section('content')

    @if(session()->has('message'))
        <div class="alert alert-{{ session()->get('alert') }}" role="alert">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="d-flex justify-content-between mb-2">
        <a href="{{ route('students.create') }}">
            <button class="btn btn-primary">Criar estudante</button>
        </a>
        <form action="{{ route('students.index') }}" method="GET" class="d-flex">
            <input type="text" name="name" id="name" class="form-control" value="{{ request()->input('name') }}">
            <button type="submit" class="btn btn-primary ml-2">Pesquisar</button>
        </form>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Telefone</th>
            <th scope="col">Email</th>
            <th scope="col">Data de nascimento</th>
            <th scope="col">Sexo</th>
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
                <td>{{ optional($student->birth)->format('d/m/Y') }}</td>
                <td>{{ $student->gender }}</td>
                <td>
                    <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
                <td>
                    <a href="{{ route('students.edit', $student->id) }}">
                        <button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                    </a>
                </td>
            </tr>
        @empty
            <p>Não há estudantes cadastrados.</p>
        @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $students->links() }}
    </div>
@endsection

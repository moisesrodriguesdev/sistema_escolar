@extends('layout.master')
@section('content')
    <form action="{{ route('students.store') }}" method="post">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="cellphone">Telefone</label>
            <input type="text" class="form-control" id="cellphone" name="cellphone">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label for="birth">Data de nascimento</label>
            <input type="date" class="form-control" id="birth" name="birth" placeholder="name@example.com">
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" id="MasGender" value="Masculino">
            <label class="form-check-label" for="MasGender">
                Masculino
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" id="FemGender" value="Feminino">
            <label class="form-check-label" for="FemGender">
                Feminino
            </label>
        </div>
        <div class="form-group">
            <label for="teams">Selecione a turma</label>
            <select class="form-control" id="teams" name="team_id">
                @foreach($teams as $team)
                    <option value="{{ $team->id }}">{{ $team->shift }} - {{ $team->year }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">VAI CARALHO</button>
    </form>
@endsection

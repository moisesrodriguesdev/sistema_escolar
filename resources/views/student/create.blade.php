@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center" style="background: #44494D; color:white;">Cadastrar aluno</div>
                <div class="card-body">
                    <form action="{{ route('students.store') }}" method="post">
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
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <label for="role">Nome</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                       required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <label for="role">Telefone</label>
                                <input type="text" class="form-control" id="cellphone" name="cellphone">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <label for="role">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       value="{{ old('email') }}" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <label for="role">Data de nascimento</label>
                                <input type="date" class="form-control" id="birth" name="birth">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <label for="role">Selecione a turma</label>
                                <select class="form-control" id="teams" name="team_id">
                                    <option value=""></option>
                                    @foreach($teams->items() as $team)
                                        <option value="{{ $team->id }}">{{ $team->shift }} - {{ $team->teach_level }} - {{ $team->year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success" type="submit"><i class="fas fa-save"></i> Salvar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

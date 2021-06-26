@extends('layout.master')
@section('content')
    @section('titulo','Cadastrar turma')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center" style="background: #44494D; color:white;">Cadastrar turma</div>
                <div class="card-body">
                    <form action="{{ route('teams.store') }}" method="post">
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
                                <label for="role">Ano</label>
                                <input type="text" class="form-control" id="year" name="year" value="{{ old('year') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <label for="role">Nível de ensino</label>
                                <input type="text" class="form-control" id="teach_level" name="teach_level">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <label for="role">Serie</label>
                                <input type="text" class="form-control" id="serie" name="serie" value="{{ old('serie') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <label for="role">Turno</label>
                                <input type="text" class="form-control" id="shift" name="shift">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <label for="role">Selecione a escola</label>
                                <select class="form-control" id="schools" name="school_id" required>
                                    <option value=""></option>
                                    @foreach($schools as $school)
                                        <option value="{{ $school->id }}">{{ $school->name }}</option>
                                    @endforeach
                                </select>
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

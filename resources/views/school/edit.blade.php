@extends('layout.master')
@section('content')
    @section('titulo','Editar escola')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center" style="background: #44494D; color:white;">Cadastrar escola</div>
                <div class="card-body">
                    <form action="{{ route('schools.update', $school->id) }}" method="post">
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
                        @method('PUT')
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <label for="role">Nome</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ $school->name }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <label for="role">Endereço</label>
                                <input type="text" class="form-control" id="address" name="address"
                                       value="{{ $school->address }}">
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('schools.index') }}">
                        <button class="btn btn-primary" type="button"><i class="fas fa-arrow-left"></i> Voltar</button>
                    </a>
                    <button class="btn btn-success" type="submit"><i class="fas fa-save"></i> Salvar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

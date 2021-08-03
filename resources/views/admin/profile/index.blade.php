@extends('adminlte::page')

@section('content_header')
    <h1>Perfil</h1>
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                <h5><i class="icon fas fa-ban"></i> Ocorreu um erro.</h5>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" color="#fff">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('profile.save') }}" method="POST" class="form-horizontal">
                @method('PUT')
                @csrf
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Nome Completo</label>
                    <div class="col-sm-10">
                        <input type="text" name="nome" value="{{ $perfil->nome }}"
                            class="form-control @error('nome') is-invalid @enderror">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Profissão</label>
                    <div class="col-sm-10">
                        <input type="text" name="profissao" value="{{ $perfil->profissao }}"
                            class="form-control @error('profissao') is-invalid @enderror">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Data de Nascimento</label>
                    <div class="col-sm-10">
                        <input type="date" name="dt_nascimento" value="{{ $perfil->dt_nascimento }}"
                            class="form-control @error('dt_nascimento') is-invalid @enderror">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" value="{{ $perfil->email }}"
                            class="form-control @error('email') is-invalid @enderror">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Telefone</label>
                    <div class="col-sm-10">
                        <input type="text" name="telefone" value="{{ $perfil->telefone }}"
                            class="form-control @error('telefone') is-invalid @enderror">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Endereço</label>
                    <div class="col-sm-10">
                        <input type="text" name="endereco" value="{{ $perfil->endereco }}"
                            class="form-control @error('endereco') is-invalid @enderror">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">CPF</label>
                    <div class="col-sm-10">
                        <input type="text" name="cpf" value="{{ $perfil->cpf }}"
                            class="form-control @error('cpf') is-invalid @enderror">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">CNPJ</label>
                    <div class="col-sm-10">
                        <input type="text" name="cnpj" value="{{ $perfil->cnpj }}"
                            class="form-control @error('cnpj') is-invalid @enderror">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="submit" value="Salvar" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@extends('adminlte::page')

@section('content_header')
    <h1>Mudar Senha</h1>
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
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('settings.save') }}" method="POST" class="form-horizontal">
                @method('PUT')
                @csrf
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Nova Senha</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Confirmação</label>
                    <div class="col-sm-10">
                        <input type="password" name="password_confirmation"
                            class="form-control @error('password') is-invalid @enderror">
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

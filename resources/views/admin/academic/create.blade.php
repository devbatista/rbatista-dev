@extends('adminlte::page')

@section('content_header')
    <h1>Novo item</h1>
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" color="#fff">&times;</span>
            </button>
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
            <form action="{{ route('academic.store') }}" method="POST" class="form-horizontal">
                @csrf
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Título</label>
                    <div class="col-sm-10">
                        <input type="text" name="titulo" value="" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Instituição</label>
                    <div class="col-sm-10">
                        <input type="text" name="instituicao" value="" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Início:</label>
                    <div class="col-sm-10">
                        <input type="number" min="1900" name="inicio" class="form-control" placeholder="ex: 2021">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Fim:</label>
                    <div class="col-sm-10">
                        <input type="number" min="1900" name="fim" class="form-control" placeholder="ex: 2021">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Finalizado:</label>
                    <div class="col-sm-10 d-flex">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="finalizado" id="atualmente"
                                value="atualmente">
                            <label class="form-check-label" for="atualmente">Atualmente</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="finalizado" id="incompleto"
                                value="incompleto">
                            <label class="form-check-label" for="incompleto">Incompleto</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="finalizado" id="finalizado"
                                value="finalizado" checked>
                            <label class="form-check-label" for="finalizado">Finalizado</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Tipo</label>
                    <div class="col-sm-10">
                        <input type="text" name="tipo" value="" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Descrição</label>
                    <div class="col-sm-10">
                        <textarea rows="5" class="form-control" name="descricao"></textarea>
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

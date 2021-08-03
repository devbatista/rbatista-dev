@extends('adminlte::page')

@section('content_header')
    <h1>Novo item de portfolio</h1>
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
            <form action="{{ route('portfolio.store') }}" method="POST" class="form-horizontal"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Título</label>
                    <div class="col-sm-10">
                        <input type="text" name="titulo" value="" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Link</label>
                    <div class="col-sm-10">
                        <input type="text" name="link" value="" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Imagem</label>
                    <div class="col-sm-10 d-flex">
                        <input type="file" name="thumb" class="form-control-file align-self-center">
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

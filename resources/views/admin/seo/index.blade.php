@extends('adminlte::page')

@section('content_header')
    <h1>SEO</h1>
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
            <form action="{{ route('seo.update') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Palavras chaves</label>
                    <div class="col-sm-10">
                        <input type="text" name="keywords" value="@php echo ($seo && $seo->keywords) ? $seo->keywords : ''; @endphp"
                            class="form-control @error('keywords') is-invalid @enderror" placeholder="Separados por vírgulas">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Descrição google</label>
                    <div class="col-sm-10">
                        <textarea class="form-control @error('descricao') is-invalid @enderror" name="descricao" id="" rows="3">@php echo ($seo && $seo->descricao) ? $seo->descricao : ''; @endphp</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Autor</label>
                    <div class="col-sm-10">
                        <input type="text" name="autor" value="@php echo ($seo && $seo->autor) ? $seo->autor : ''; @endphp"
                            class="form-control @error('dt_nascimento') is-invalid @enderror">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Imagem de publicação</label>
                    <div class="col-sm-10 d-flex">
                        <input type="file" name="og_imagem" class="form-control-file align-self-center">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Descrição de publicação</label>
                    <div class="col-sm-10">
                        <textarea class="form-control @error('og_descricao') is-invalid @enderror" name="og_descricao" id="" rows="2">@php echo ($seo && $seo->og_descricao) ? $seo->og_descricao : ''; @endphp</textarea>
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

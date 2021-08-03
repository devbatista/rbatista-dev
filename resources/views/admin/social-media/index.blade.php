@extends('adminlte::page')

@section('content_header')
    <h1>
        Redes Sociais
        <a href="{{ route('social-media.create') }}" class="btn btn-sm btn-success float-right">Nova Rede Social</a>
    </h1>

    @if (session('success'))
        <br>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" color="#fff">&times;</span>
            </button>
        </div>
    @endif
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>link</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($redesSociais as $item)
                        <tr>
                            <td>{{ $item->nome }}</td>
                            <td>{{ $item->link }}</td>
                            <td>
                                <a href="{{ route('social-media.edit', ['social_medium' => $item->id]) }}"
                                    class="btn btn-sm btn-warning">Editar</a>

                                <form class="d-inline" action="{{ route('social-media.destroy', ['social_medium' => $item->id]) }}"
                                    method="POST" onsubmit="return confirm('Deseja mesmo deletar?')">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
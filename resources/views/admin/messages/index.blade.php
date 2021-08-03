@extends('adminlte::page')

@section('content_header')
    <h1>
        Mensagens
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
                        <th>Autor</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th>Mensagem</th>
                        <th>Ver</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mensagens as $mensagem)
                        <tr>
                            <td>{{ $mensagem->nome }}</td>
                            <td>{{ $mensagem->telefone }}</td>
                            <td>{{ $mensagem->email }}</td>
                            <td>{{ $mensagem->mensagem }}</td>
                            <td>
                                <a href="{{ route('messages.show', ['id' => $mensagem->id]) }}"
                                    class="btn btn-sm btn-info">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@extends('adminlte::page')

@section('content_header')
    <h1>
        Mensagem
        <a href="{{ route('messages') }}" class="btn btn-sm btn-info float-right">Voltar</a>
    </h1>
@endsection


@section('content')
    <div class="card card-primary">
        <div class="card-body p-0">
            <div class="mailbox-read-info">
                <h4>{{ $mensagem->nome }}</h4>
                <h6>Email: {{ $mensagem->email }}</h6>
                <h6>Telefone: {{ $mensagem->telefone }}
                    <span class="mailbox-read-time float-right">{{ $mensagem->data_hora }}</span>
                </h6>
            </div>
            <div class="mailbox-read-message p-4">
                {{ $mensagem->mensagem }}
            </div>
        </div>
    </div>

    <div>
        <form class="d-inline" action="{{ route('messages.destroy', ['id' => $mensagem->id]) }}"
            method="POST" onsubmit="return confirm('Deseja mesmo deletar?')">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-sm btn-danger float-right">Excluir Mensagem</button>
        </form>
    </div>
@endsection

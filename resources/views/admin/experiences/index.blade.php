@extends('adminlte::page')

@section('content_header')
    <h1>
        Experiências
        <a href="{{ route('experiences.create') }}" class="btn btn-sm btn-success float-right">Novo item</a>
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
                        <th>Cargo</th>
                        <th>Empresa</th>
                        <th>Inicio</th>
                        <th>Fim</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($experiencias as $experiencia)
                        <tr>
                            <td>{{ $experiencia->cargo }}</td>
                            <td>{{ $experiencia->empresa }}</td>
                            <td>{{ $experiencia->inicio }}</td>
                            <td>{{ $experiencia->fim }}</td>
                            <td>
                                <a href="{{ route('experiences.edit', ['experience' => $experiencia->id]) }}"
                                    class="btn btn-sm btn-warning">Editar</a>

                                <form class="d-inline" action="{{ route('experiences.destroy', ['experience' => $experiencia->id]) }}"
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

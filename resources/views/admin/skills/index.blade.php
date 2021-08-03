@extends('adminlte::page')

@section('content_header')
    <h1>
        Skills
        <a href="{{ route('skills.create') }}" class="btn btn-sm btn-success float-right">Novo skill</a>
    </h1>

    @if (session('success'))
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
                        <th>Skill</th>
                        <th>%</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($skills as $skill)
                        <tr>
                            <td>{{ $skill->skill }}</td>
                            <td>{{ $skill->porcentagem }}</td>
                            <td>
                                <a href="{{ route('skills.edit', ['skill' => $skill->id]) }}"
                                    class="btn btn-sm btn-warning">Editar</a>

                                <form class="d-inline" action="{{ route('skills.destroy', ['skill' => $skill->id]) }}"
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

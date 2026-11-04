@extends('layouts.app')

@section('title', 'Atividades - GRA')
@section('heading', 'Atividades')
@section('subtitle', 'Consulte e gerencie as atividades cadastradas.')

@section('content')
    <div class="card">
        <a href="{{ route('atividades.create') }}" class="btn btn-primary">
            + Cadastrar atividade
        </a>
    </div>

    <div class="card">
        @if ($atividades->isEmpty())
            <p>Nenhuma atividade cadastrada.</p>
        @else
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Nº</th>
                            <th>Data</th>
                            <th>Horário</th>
                            <th>Usuário</th>
                            <th>Descrição</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($atividades as $atividade)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $atividade->data->format('d/m/Y') }}</td>
                                <td>
                                    {{ substr($atividade->inicio, 0, 5) }}
                                    –
                                    {{ substr($atividade->fim, 0, 5) }}
                                </td>
                                <td>{{ $atividade->usuario }}</td>
                                <td>{{ $atividade->descricao }}</td>
                                <td>
                                    <div class="actions">
                                        <a href="{{ route('atividades.edit', $atividade) }}" class="btn btn-secondary">
                                            Editar
                                        </a>

                                        <form action="{{ route('atividades.destroy', $atividade) }}" method="POST"
                                            onsubmit="return confirm('Deseja realmente excluir esta atividade?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger">
                                                Excluir
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
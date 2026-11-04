@extends('layouts.app')

@section('title', 'Dashboard - GRA')
@section('heading', 'Dashboard')
@section('subtitle', 'Últimas atividades cadastradas.')

@section('content')
    <div class="card">
        <h2>Últimas 5 atividades</h2>

        @if ($atividades->isEmpty())
            <p>Nenhuma atividade cadastrada.</p>
        @else
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Horário</th>
                            <th>Usuário</th>
                            <th>Descrição</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($atividades as $atividade)
                            <tr>
                                <td>
                                    {{ $atividade->data->format('d/m/Y') }}
                                </td>

                                <td>
                                    {{ substr($atividade->inicio, 0, 5) }}
                                    –
                                    {{ substr($atividade->fim, 0, 5) }}
                                </td>

                                <td>{{ $atividade->usuario }}</td>

                                <td>{{ $atividade->descricao }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <br>
        <a href="{{ route('atividades.index') }}" class="btn btn-primary">
            Ver todas as atividades
        </a>
    </div>
@endsection
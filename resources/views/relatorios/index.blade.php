
@extends('layouts.app')

@section('title', 'Gerar relatório - GRA')
@section('heading', 'Gerar relatório')
@section('subtitle', 'Gere um relatório mensal das atividades desenvolvidas.')

@section('content')

<div class="card">

    <h2>Relatório de atividades</h2>

    <p>
        Selecione o mês e o ano para gerar o documento Word
        com todas as atividades cadastradas no período.
    </p>

    <form action="{{ route('relatorios.gerar') }}" method="GET">

        <div class="form-group">
            <label for="mes">Mês do relatório:</label>

            <input
                type="month"
                name="mes"
                id="mes"
                value="{{ old('mes', $mes) }}"
                required
            >
        </div>

        <button type="submit" class="btn btn-primary">
            Gerar relatório DOCX
        </button>

    </form>

</div>

@endsection

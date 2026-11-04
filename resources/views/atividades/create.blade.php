@extends('layouts.app')

@section('title', 'Cadastrar atividade - GRA')
@section('heading', 'Cadastrar atividade')
@section('subtitle', 'Preencha os dados da atividade.')

@section('content')
    <div class="card">
        <form action="{{ route('atividades.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="data">Data</label>
                <input type="date" id="data" name="data" value="{{ old('data') }}" required>
            </div>

            <div class="form-group">
                <label for="inicio">Horário de início</label>
                <input type="time" id="inicio" name="inicio" value="{{ old('inicio') }}" required>
            </div>

            <div class="form-group">
                <label for="fim">Horário de término</label>
                <input type="time" id="fim" name="fim" value="{{ old('fim') }}" required>
            </div>

            <div class="form-group">
                <label for="usuario">Usuário requerente</label>
                <input type="text" id="usuario" name="usuario" value="{{ old('usuario') }}" maxlength="255" required>
            </div>

            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao" required>{{ old('descricao') }}</textarea>
            </div>

            <div class="form-group">
                <label for="solucao">Solução apresentada</label>
                <textarea id="solucao" name="solucao" required>{{ old('solucao') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                Cadastrar atividade
            </button>

            <a href="{{ route('atividades.index') }}" class="btn btn-secondary">
                Cancelar
            </a>
        </form>
    </div>
@endsection
@extends('layouts.app')

@section('title', 'Editar atividade - GRA')
@section('heading', 'Editar atividade')
@section('subtitle', 'Atualize os dados do registro selecionado.')

@section('content')
    <div class="card">
        <form action="{{ route('atividades.update', $atividade) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="data">Data</label>
                <input type="date" id="data" name="data" value="{{ old('data', $atividade->data->format('Y-m-d')) }}"
                    required>
            </div>

            <div class="form-group">
                <label for="inicio">Horário de início</label>
                <input type="time" id="inicio" name="inicio" value="{{ old('inicio', substr($atividade->inicio, 0, 5)) }}"
                    required>
            </div>

            <div class="form-group">
                <label for="fim">Horário de término</label>
                <input type="time" id="fim" name="fim" value="{{ old('fim', substr($atividade->fim, 0, 5)) }}" required>
            </div>

            <div class="form-group">
                <label for="usuario">Usuário requerente</label>
                <input type="text" id="usuario" name="usuario" value="{{ old('usuario', $atividade->usuario) }}"
                    maxlength="255" required>
            </div>

            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao" required>{{ old('descricao', $atividade->descricao) }}</textarea>
            </div>

            <div class="form-group">
                <label for="solucao">Solução apresentada</label>
                <textarea id="solucao" name="solucao" required>{{ old('solucao', $atividade->solucao) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                Salvar alterações
            </button>

            <a href="{{ route('atividades.index') }}" class="btn btn-secondary">
                Cancelar
            </a>
        </form>
    </div>
@endsection
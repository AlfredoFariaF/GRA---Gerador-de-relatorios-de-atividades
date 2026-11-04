@extends('layouts.app')

@section('title', 'Dashboard - GRA')
@section('heading', 'Dashboard')
@section('subtitle', 'Bem-vindo ao Gerador de Relatórios de Atividades.')

@section('content')
    <div class="card">
        <h2>Gerenciamento de atividades</h2>
        <p>Cadastre, consulte e mantenha seus registros organizados.</p>

        <a href="{{ route('atividades.index') }}" class="btn btn-primary">
            Ver atividades
        </a>

        <a href="{{ route('atividades.create') }}" class="btn btn-secondary">
            Cadastrar atividade
        </a>
    </div>
@endsection
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GRA - Atividades')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/estilo.css') }}">
</head>

<body>

    <aside class="sidebar">
        <div class="brand">GRA</div>

        <nav class="menu">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Dashboard
            </a>

            <a href="{{ route('atividades.index') }}"
                class="{{ request()->routeIs('atividades.index', 'atividades.edit') ? 'active' : '' }}">
                Atividades
            </a>

            <a href="{{ route('atividades.create') }}"
                class="{{ request()->routeIs('atividades.create') ? 'active' : '' }}">
                Cadastrar atividade
            </a>
        </nav>
    </aside>

    <main class="main">
        <header class="topbar">
            <h1>@yield('heading', 'GRA')</h1>
            <p>@yield('subtitle', 'Gerador de Relatórios de Atividades')</p>
        </header>

        @if (session('sucesso'))
            <div class="alert-success">
                {{ session('sucesso') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-error">
                <strong>Verifique os campos informados:</strong>
                <ul>
                    @foreach ($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

</body>

</html>
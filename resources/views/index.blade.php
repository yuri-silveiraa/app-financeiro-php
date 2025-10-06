<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Meu App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-secondary text-white">

    <main class="py-5">
        @hasSection('content')
        @yield('content')
        @else
        <div class="text-center justify-content-center">
            <h1>Bem-vindo ao App Financeiro!</h1>
            <p>Gerencie seus gastos e receitas com facilidade.</p>
            <a class="btn btn-primary" href="{{ route('login') }}">Entrar</a>
        </div>
        @endif
    </main>

</body>
</html>

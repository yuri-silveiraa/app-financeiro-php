@extends('index')

@section('title', 'Login')

@section('content')
<div class="col-md-6 offset-md-3">
    <h2 class="text-center">Entrar</h2>

    {{-- Mensagens de erro --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulário de Login --}}
    <form action="{{ route('login.submit') }}" method="POST" class="mt-4">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" id="email" 
                   value="{{ old('email') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input type="password" name="password" id="password" 
                   class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>

    <div class="text-center mt-3">
        <p>Não tem uma conta?</p>
        <a href="{{ route('users.create') }}" class="btn btn-secondary">Criar Conta</a>
    </div>
</div>
@endsection

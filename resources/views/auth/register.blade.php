@extends('index')

@section('title', 'Criar Conta')

@section('content')
<div class="col-md-6 offset-md-3">
    <h2 class="text-center">Criar Conta</h2>

    {{-- Exibe erros de validação --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulário de registro --}}
    <form action="{{ route('users.store') }}" method="POST" class="mt-4">
        @csrf

        @foreach ($fields as $field)
            <input type="hidden" name="fields[]" value="{{ $field }}">
        @endforeach
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" id="name" 
                   value="{{ old('name') }}" class="form-control" required>
        </div>

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

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Senha</label>
            <input type="password" name="password_confirmation" id="password_confirmation" 
                   class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Criar Conta</button>
    </form>

    <div class="text-center mt-3">
        <p>Já tem uma conta?</p>
        <a href="{{ route('login') }}" class="btn btn-secondary">Fazer Login</a>
    </div>
</div>
@endsection

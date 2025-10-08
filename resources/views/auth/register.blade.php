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
            <div class="mb-3">
                <label for="{{ $field }}" class="form-label">{{ ucfirst($field) }}</label>
                <input type="text" name="{{ $field }}" id="{{ $field }}"
                       value="{{ old($field) }}" class="form-control" required>
            </div>
        @endforeach
        
        <button type="submit" class="btn btn-success w-100">Criar Conta</button>
    </form>

    <div class="text-center mt-3">
        <p>Já tem uma conta?</p>
        <a href="{{ route('login') }}" class="btn btn-dark">Fazer Login</a>
    </div>
</div>
@endsection

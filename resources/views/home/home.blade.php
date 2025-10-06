@extends('index')

@section('title', 'Página Inicial')

@section('content')
<div class="text-center justify-content-center">
  <h1>Bem-vindo ao App Financeiro!</h1>
  <p>Gerencie seus gastos e receitas com facilidade.</p>
  <a class="btn btn-primary" href="{{ route('login') }}">Entrar</a>
</div>
@endsection
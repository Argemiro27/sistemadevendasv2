@extends('dashboard.layout')

@section('content')
  <div class="container mt-4">
    <h1 class="mb-4">Sistema de Vendas</h1>
    <p>Olá, {{ Auth::user()->name }}, seja bem-vindo!</p>
  </div>
@endsection

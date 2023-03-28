@extends('dashboard.layout')

@section('content')
  <div class="container mt-4">
    <h1 class="mb-4">Cadastrar Clientes</h1>
    <form method="POST" action="{{ route('clientes.store') }}">
      @csrf
      <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" class="form-control" id="nome" name="nome" required>
      </div>

      <div class="form-group">
        <label for="telefone">Telefone</label>
        <input type="text" class="form-control" id="telefone" name="telefone" required>
      </div>

      <div class="form-group">
        <label for="cpf">CPF</label>
        <input type="text" class="form-control" id="cpf" name="cpf" required>
      </div>

      <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
  </div>
@endsection

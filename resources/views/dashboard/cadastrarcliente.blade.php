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

      <button type="submit" class="btn btn-primary submit">Cadastrar</button>
    </form>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
  </div>
@endsection

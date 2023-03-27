@extends('dashboard.layout')

@section('content')
<script src="{{ asset('js/vendas.js') }}"></script>
<script src="{{ asset('js/simulaparcelas.js') }}"></script>
  <div class="container mt-4">
    <h1 class="mb-4">Cadastrar Vendas</h1>
    <form method="POST" action="{{ route('vendas.store') }}">
      @csrf
      <div class="form-group">
        <label for="cliente">Nome do Cliente:</label>
        <input type="text" class="form-control" id="cliente" name="cliente" required>
      </div>

      <div class="form-group">
        <label for="itens">Itens da Venda:</label>
        <div id="itens-container">
          <div class="row mb-2">
            <div class="col">
              <input type="text" class="form-control item" name="item[]" required>
            </div>
            <div class="col">
              <input type="number" class="form-control valor" name="valor[]" required>
            </div>
            <div class="col">
              <button type="button" class="btn btn-danger remover-item">&times;</button>
            </div>
          </div>
        </div>
        <button type="button" id="adicionar-item" class="btn btn-primary">Adicionar Item</button>

        <div class="form-group">
          <label for="total">Total:</label>
          <input type="text" class="form-control" id="total" name="total" readonly>
        </div>
      </div>

      <div class="form-group">
        <label for="forma_pagamento">Forma de Pagamento:</label>
        <select class="form-control" id="forma_pagamento" name="forma_pagamento" required>
          <option>Selecione a forma de pagamento</option>
          <option value="a_vista">À vista</option>
          <option value="parcelado">Parcelado</option>
        </select>
      </div>

      <div id="parcelado-container" style="display: none;">
        <div class="form-group">
          <label for="num_parcelas">Número de Parcelas:</label>
          <input type="number" class="form-control" id="num_parcelas" name="num_parcelas">
        </div>
        <button type="button" id="simular-parcelas" class="btn btn-primary">Simular</button>
        <table class="table table-bordered" id="parcelas" style="display: none;">
          <thead>
            <tr>
              <th>ID</th>
              <th>Data da Parcela</th>
              <th>Valor da Parcela</th>
              <th>Observações</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
  </div>
@endsection

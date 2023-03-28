@extends('dashboard.layout')

@section('content')
  <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
  <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
  <div class="container mt-4">
    <h1 class="mb-4">Listagem de vendas</h1>

    <table class="table">
      <thead>
        <tr>
          <th>Venda</th>
          <th>Data e Hora</th>
          <th>Usuário</th>
          <th>Cliente</th>
          <th>Produto</th>
          <th>Quantidade</th>
          <th>Valor Unitário</th>
          <th>Valor Total</th>
          <th>Forma de Pagamento</th>
          <th>Editar</th>
          <th>Remover</th>
        </tr>
      </thead>
      <tbody>
        @foreach($vendas as $nome_venda => $vendas_grupo)
        <tr>
          <td rowspan="{{ $vendas_grupo->count() }}">
            {{ $nome_venda }}
          </td>
          @foreach($vendas_grupo as $key => $venda)
          @if($key > 0)
          <tr>
          @endif
          <td>{{ $venda->created_at }}</td>
          <td>{{ $venda->user->name }}</td>
          <td>{{ $venda->cliente->nome }}</td>
          <td>{{ $venda->produto->nome }}</td>
          <td>{{ $venda->quantidade }}</td>
          <td>{{ $venda->produto->preco }}</td>
          @if($key == 0)
          <td rowspan="{{ $vendas_grupo->count() }}">{{ $venda->total }}</td>
          <td rowspan="{{ $vendas_grupo->count() }}">{{ $venda->forma_pagamento }}</td>
          <td rowspan="{{ $vendas_grupo->count() }}">
            <a href="{{ route('vendas.edit', $venda->id) }}" class="btn btn-primary">Editar</a>
          </td>
          <td rowspan="{{ $vendas_grupo->count() }}">
            <form action="{{ route('vendas.destroy', $venda->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Remover</button>
            </form>
          </td>
          </tr>
          @endif
          @endforeach
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection

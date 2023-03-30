@extends('dashboard.layout')

@section('content')

<div class="container mt-4">
    <h1 class="mb-4">Cadastrar Vendas</h1>
    <form action="{{ route('vendas.store', ['dados' => ['item1', 'item2', 'item3']]) }}">
    @csrf
    <div>
        <label for="cliente_nome">Nome do Cliente:</label>
        <input type="text" class="form-control" id="cliente_nome" name="cliente_nome">
        <input type="hidden" class="form-control" id="cliente_id" name="cliente_id">

        <label for="produto">Produto:</label>
        <select name="produto" id="produto" class="form-control">
            @php
                $produtos = App\Models\Produtos::all();
            @endphp
            @foreach($produtos as $produto)
                <option value="{{ $produto->id }}" data-preco="{{ $produto->preco }}">{{ $produto->nome }}</option>
            @endforeach
        </select>

        <label for="quantidade">Quantidade:</label>
        <input type="number" class="form-control"  id="quantidade" name="quantidade" value="1">

        <button type="button" id="adicionar" class="btn btn-primary mt-3">Adicionar</button>

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Valor Unitário</th>
                    <th>Valor Total</th>
                </tr>
            </thead>
            <tbody id="produtos-carrinho">
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-right"><strong>Total</strong></td>
                    <td><input type="text" class="form-control" id="total" name="total" readonly></td>
                </tr>
            </tfoot>
        </table>

        <label for="forma_pagamento">Forma de pagamento:</label>
        <select name="forma_pagamento" id="forma_pagamento">
            <option value="vista">À vista</option>
            <option value="parcelado">Parcelado</option>
        </select>
        <div id="parcelado-campo" style="display:none;">
            <label for="parcelado-quantidade">Quantidade de parcelas:</label>
            <input type="number" name="parcelado-quantidade" id="parcelado-quantidade">
        </div>

        <button id="finalizar-compra" type="submit" class="btn btn-primary">Cadastrar venda</button>
    </div>
    </form>
    <div class="form-group">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
</div>

<script>
    const forma_pagamento = document.getElementById("forma_pagamento");
    const parceladoCampo = document.getElementById("parcelado-campo");
    forma_pagamento.addEventListener("change", function () {
      if (this.value === "parcelado") {
        parceladoCampo.style.display = "block";
      } else {
        parceladoCampo.style.display = "none";
      }
    });
</script>

@endsection



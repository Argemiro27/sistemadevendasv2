@extends('dashboard.layout')

@section('content')

<div class="container mt-4">
    <h1 class="mb-4">Editar venda</h1>
    <form method="POST" action="{{ route('vendas.update', $venda->id) }}">
    @csrf
    <div>
        <label for="cliente_nome">Nome do Cliente:</label>
        <input type="text" class="form-control" id="cliente_nome" name="cliente_nome">
        <input type="hidden" class="form-control" id="cliente_id" name="cliente_id">

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th hidden>ID produto</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Valor Unitário</th>
                    <th>Valor Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $produtos = App\Models\Produtos::all();
                @endphp
                @foreach($produtos as $produto)
                    <tr>
                        <td hidden id="produto_id" name="produto_id">{{ $produto->id }}</td>
                        <td id="produto_nome" name="produto_nome">{{ $produto->nome }}</td>
                        <td id="quantidade" name="quantidade">
                            <input type="number" class="form-control" name="quantidade[{{ $produto->id }}]" value="0">
                            <input type="hidden" name="produto_id[{{ $produto->id }}]" value="{{ $produto->id }}">
                        </td>
                        <td id="valorunitario" name="valorunitario">{{ $produto->preco }}</td>
                        <td id="valortotal" name="valortotal">{{ $produto->valortotal }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-right"><strong>Total</strong></td>
                    <td><input type="text" class="form-control" id="total" name="total" readonly></td>
                </tr>
            </tfoot>
        </table>

        <label for="forma_pagamento">Forma de pagamento:</label><br>
        <select name="forma_pagamento" id="forma_pagamento">
            <option value="À vista">À vista</option>
            <option value="Parcelado">Parcelado</option>
        </select>
        <div id="parcelado-campo" style="display:none;">
            <label for="parcelado-quantidade">Quantidade de parcelas:</label>
            <input type="number" name="nparcelas" id="nparcelas">
        </div>
        <br>
        <button id="finalizar-compra" type="submit" class="btn btn-primary submit">Editar venda</button>
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


@endsection





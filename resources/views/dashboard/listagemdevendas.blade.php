@extends('dashboard.layout')

@section('content')
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <div class="container mt-4">
        <h1 class="mb-4">Listagem de vendas</h1>

        @php
            $valor_total_geral = 0;
        @endphp

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
                    <th>Forma de Pagamento</th>
                    <th>Parcelas</th>
                    <th>Editar</th>
                    <th>Remover</th>
                </tr>
            </thead>
            <tbody>
            @foreach($vendas as $nome_venda => $vendas_grupo)
                @php
                    $valor_total_grupo = 0;
                @endphp
                @foreach($vendas_grupo as $key => $venda)
                    <tr>
                        @if($key == 0)
                            <td rowspan="{{ $vendas_grupo->count() }}">
                                {{ $nome_venda }}
                            </td>
                        @endif
                        <td>{{ $venda->created_at }}</td>
                        <td>{{ $venda->user->name }}</td>
                        <td>{{ $venda->cliente->nome }}</td>
                        <td>{{ $venda->produto->nome }}</td>
                        <td>{{ $venda->quantidade }}</td>
                        <td>{{ $venda->produto->preco }}</td>
                        @if($key == 0)
                            <td rowspan="{{ $vendas_grupo->count() }}">{{ $venda->forma_pagamento }}</td>
                            <td rowspan="{{ $vendas_grupo->count() }}">{{ $venda->qtd_parcelas }}</td>
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
                        @endif
                        @php
                            $valor_total_geral += $venda->quantidade * $venda->produto->preco;
                        @endphp
                    </tr>
                @endforeach
                <tr>
                <td colspan="7"></td>
                <td><strong>Valor Total:</strong></td>
                <td>R$ {{ $valor_total_geral }}</td>
                <td colspan="3"></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

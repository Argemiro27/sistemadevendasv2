@extends('dashboard.layout')

@section('content')

    <div class="container mt-4">
        <h1 class="mb-4">Listagem de vendas</h1>

        @php
            $valor_total_geral = 0;
        @endphp

        <table class="table">
            <thead>
                <tr>
                    <th>Código da venda</th>
                    <th>Data e Hora</th>
                    <th>Usuário</th>
                    <th>Cliente</th>
                    <th>Forma de Pagamento</th>
                    <th>Status</th>
                    <th>Parcelas</th>
                    <th>Valor</th>
                    <th>Editar</th>
                    <th>Remover</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vendas as $venda)
                    <tr>
                        <td>{{ $venda->id }}</td>
                        <td>{{ $venda->created_at }}</td>
                        <td>{{ $venda->usuario->nome }}</td>
                        <td>{{ $venda->cliente->nome }}</td>
                        <td>{{ $venda->forma_pagamento }}</td>
                        <td>{{ $venda->status }}</td>
                        <td>{{ $venda->numParcelas }}</td>
                        <td>{{ $venda->valor }}</td>
                        <td><a href="{{ route('venda.edit', $venda->id) }}">Editar</a></td>
                        <td>
                            <form action="{{ route('venda.destroy', $venda->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link">Remover</button>
                            </form>
                        </td>
                    </tr>
                    @php
                        $valor_total_geral += $venda->valor;
                    @endphp
                @endforeach
            </tbody>
        </table>
        <p>Valor total geral: R$ {{ number_format($valor_total_geral, 2, ',', '.') }}</p>
    </div>
@endsection

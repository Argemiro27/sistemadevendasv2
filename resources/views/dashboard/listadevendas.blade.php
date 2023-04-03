@extends('dashboard.layout')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-cqa8U6O14z6EwU+vOG02pW5b5bbmb0p0eSwgC9E5aUmfrssx53mjjm1bkl7JhMVprwt/0W/IN2X9NC+ws75BQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="container mt-4">
        <h1 class="mb-4">Listagem de vendas</h1>

        @php
            $valor_total_geral = 0;
        @endphp

        <table class="table">
            <thead>
                <tr>
                    <th>Data e Hora</th>
                    <th>Usuário</th>
                    <th>Cliente</th>
                    <th>Forma de Pagamento</th>
                    <th>Status</th>
                    <th>Valor</th>
                    <th>Parcelas</th>
                    <th>Editar</th>
                    <th>Remover</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vendas as $venda)
                    <tr>
                        <td>{{ $venda->created_at }}</td>
                        <td>{{ $venda->usuario->name }}</td>
                        <td>{{ $venda->cliente->nome ?? 'Cliente desconhecido' }}</td>

                        <td>{{ $venda->forma_pagamento }}</td>
                        <td>{{ $venda->status }}</td>
                        <td>{{ $venda->valortotal }}</td>
                        <td>
                            @if($venda->forma_pagamento == 'Parcelado')
                                <?php $parcelas = $venda->parcelas; ?>
                                <?php $valorTotalParcelado = $parcelas->sum('valor'); ?>
                                {{ count($parcelas) }}x de R$ {{ number_format($valorTotalParcelado / count($parcelas), 2, ',', '.') }}<br>
                            @else
                                R$ {{ number_format($venda->itensVenda->sum('valortotal'), 2, ',', '.') }}
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('vendas.edit', $venda->id) }}" class="btn btn-primary">Editar</a>
                        </td>

                        <td>
                            <form action="{{ route('vendas.destroy', $venda->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta venda?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

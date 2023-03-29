@extends('dashboard.layout')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Cadastrar Vendas</h1>
    <form action="{{ route('vendas.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="nome_venda">Nome/ Identificação da venda:</label>
        <input type="text" class="form-control" id="nome_venda" name="nome_venda">
    </div>
    <div class="form-group">
        <label for="cliente">Cliente</label>
        <select class="form-control" id="cliente" name="cliente_id">
            @foreach ($clientes as $cliente)
                <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="produtos">Produtos</label>
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produtos as $produto)
                    <tr>
                        <td>{{ $produto->nome }}</td>
                        <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                        <td>
                            <input type="number" class="form-control produto-quantidade" name="produtos[{{ $produto->id }}]" value="0">

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="form-group">
        <label for="total">Total</label>
        <input type="text" class="form-control" id="total" name="total" readonly>
    </div>
    <div class="form-group" id="parcelas" style="display:none">
        <label for="num_parcelas">Número de Parcelas:</label>
        <input type="number" class="form-control" id="num_parcelas" name="num_parcelas" value="1" min="1" max="12">
    </div>
    <div class="form-group">
        <label for="forma_pagamento">Forma de Pagamento:</label>
        <select class="form-control" id="forma_pagamento" name="forma_pagamento">
            <option value="À vista">À vista</option>
            <option value="Parcelado">Parcelado</option>
        </select>
    </div>

    <div class="form-group">
    <button type="submit" class="btn btn-primary">Cadastrar venda</button>
    </form>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
</div>


<script>
const produtos = document.querySelectorAll('.produto-quantidade');
const totalInput = document.querySelector('#total');

produtos.forEach(produto => {
    produto.addEventListener('change', () => {
        let total = 0;
        produtos.forEach(produto => {
            total += produto.value * parseFloat(produto.parentNode.previousElementSibling.textContent.replace('R$ ', '').replace(',', '.'));
        });
        totalInput.value = total.toFixed(2);
    });
});
</script>



<script>
const formaPagamento = document.querySelector('#forma_pagamento');
const parcelasDiv = document.querySelector('#parcelas');

formaPagamento.addEventListener('change', () => {
    if (formaPagamento.value === 'À vista') {
        parcelasDiv.style.display = 'none';
    } else {
        parcelasDiv.style.display = 'block';
    }
});
</script>


@endsection


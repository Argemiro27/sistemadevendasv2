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
                            <input type="number" class="form-control produto-quantidade" name="produtos[{{ $produto->id }}]" value="{{ $produto->id }}">

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="form-group">
        <label for="total">Total</label>
        <input type="text" class="form-control" id="total" name="total" readonly>
        <input type="hidden" name="total" id="total-input">
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

    produtos.forEach(produto => {
        produto.addEventListener('change', () => {
            let total = 0;
            produtos.forEach(produto => {
                total += produto.value * parseFloat(produto.parentNode.previousElementSibling.textContent.replace('R$ ', '').replace(',', '.'));
            });
            document.querySelector('#total').value = `R$ ${total.toFixed(2).replace('.', ',')}`;
        });
    });
</script>
@endsection

<div class="container mt-4">
    <h1>Editar Venda</h1>

    <form action="{{ route('vendas.update', $venda->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="cliente_id">Cliente</label>
            <select name="cliente_id" id="cliente_id" class="form-control">
                <option value="">Selecione um cliente</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ $cliente->id == $venda->cliente_id ? 'selected' : '' }}>{{ $cliente->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="forma_pagamento">Forma de Pagamento</label>
            <select name="forma_pagamento" id="forma_pagamento" class="form-control">
                <option value="À vista" {{ $venda->forma_pagamento == 'À vista' ? 'selected' : '' }}>À vista</option>
                <option value="Parcelado" {{ $venda->forma_pagamento == 'Parcelado' ? 'selected' : '' }}>Parcelado</option>
            </select>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="Pendente" {{ $venda->status == 'Pendente' ? 'selected' : '' }}>Pendente</option>
                <option value="Concluído" {{ $venda->status == 'Concluído' ? 'selected' : '' }}>Concluído</option>
            </select>
        </div>

        <div class="form-group">
            <label for="valorTotal">Valor Total</label>
            <input type="text" name="valorTotal" id="valorTotal" class="form-control" value="{{ $venda->valorTotal }}">
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>

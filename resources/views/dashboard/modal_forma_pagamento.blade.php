<div class="modal fade" id="modalFormaPagamento" tabindex="-1" role="dialog" aria-labelledby="modalFormaPagamentoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormaPagamentoLabel">Forma de pagamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ route('vendas.cadastrar') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="forma_pagamento">Forma de pagamento</label>
                        <select class="form-control" id="forma_pagamento" name="forma_pagamento">
                            <option value="avista">À vista</option>
                            <option value="parcelado">Parcelado</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

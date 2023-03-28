<div class="modal fade" id="modalFormaPagamento" tabindex="-1" role="dialog" aria-labelledby="modalFormaPagamentoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #173055 !important;">
            <div class="modal-header" style="border-color: #334b6e; border-width: 2px">
                <h5 class="modal-title" id="modalFormaPagamentoLabel">Forma de pagamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ route('vendas.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="forma_pagamento">Forma de pagamento</label>
                        <select class="form-control" id="forma_pagamento" name="forma_pagamento">
                            <option value="avista">À vista</option>
                            <option value="parcelado">Parcelado</option>
                        </select>
                    </div>
                    <div id="parcelas_div" style="display: none;">
                        <div class="form-group">
                            <label for="qtd_parcelas">Número de parcelas</label>
                            <input type="number" class="form-control" id="qtd_parcelas" name="qtd_parcelas" min="2" max="12" value="2" required>
                        </div>
                        <table class="table" id="table_parcelas">
                            <thead>
                                <tr>
                                    <th>Parcela</th>
                                    <th>Data de vencimento</th>
                                    <th>Valor da parcela</th>
                                    <th>Observação</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer" style="border-color: #334b6e; border-width: 2px">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#forma_pagamento").change(function(){
            if($(this).val() === "parcelado"){
                $("#parcelas_div").show();
            } else {
                $("#parcelas_div").hide();
            }
        });
        $("#qtd_parcelas").change(function(){
            var qtdParcelas = $(this).val();
            var valorTotal = parseFloat($("#total").val());
            var valorParcela = (valorTotal / qtdParcelas).toFixed(2);
            var html = "";
            for(var i=1; i<=qtdParcelas; i++){
                var dataParcela = moment().add(i, 'M').format('YYYY-MM-DD');
                html += "<tr><td><input type='text' class='form-control' value='"+i+"'></td><td><input type='text' class='form-control' value='"+dataParcela+"'></td><td><input type='text' class='form-control' value='"+valorParcela+"'></td><td><input type='text' class='form-control'></td></tr>";
            }
            $("#table_parcelas tbody").html(html);
        });
    });
</script>


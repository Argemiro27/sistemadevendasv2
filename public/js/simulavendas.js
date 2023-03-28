
    function simularParcelas() {
        var valorTotal = parseFloat(document.getElementById('valor_total').value);
        var qtdParcelas = parseInt(document.getElementById('qtd_parcelas').value);
        var valorParcela = valorTotal / qtdParcelas;
        var parcelas = [];
        var data = new Date();
        var dia = data.getDate();
        var mes = data.getMonth() + 1;
        var ano = data.getFullYear();
        var observacao = '';
        for (var i = 1; i <= qtdParcelas; i++) {
            parcelas.push({
                numero: i,
                valor: valorParcela.toFixed(2),
                data: dia + '/' + mes + '/' + ano,
                observacao: observacao
            });
            mes++;
            if (mes > 12) {
                mes = 1;
                ano++;
            }
        }
        document.getElementById('parcelas').innerHTML = '';
        for (var i = 0; i < parcelas.length; i++) {
            var row = document.createElement('tr');
            var cellNumero = document.createElement('td');
            var cellValor = document.createElement('td');
            var cellData = document.createElement('td');
            var cellObservacao = document.createElement('td');
            cellNumero.innerHTML = parcelas[i].numero;
            cellValor.innerHTML = parcelas[i].valor;
            cellData.innerHTML = parcelas[i].data;
            cellObservacao.innerHTML = '<input type="text" class="form-control" name="observacoes[]">';
            row.appendChild(cellNumero);
            row.appendChild(cellValor);
            row.appendChild(cellData);
            row.appendChild(cellObservacao);
            document.getElementById('parcelas').appendChild(row);
        }
    }


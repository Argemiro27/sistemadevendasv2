function simulaparcelas() {
    var numParcelas = $('#num_parcelas').val();
    if (numParcelas > 0) {
      var valorTotal = parseFloat($('#total').val());
      var valorParcela = valorTotal / numParcelas;
      var tbody = $('#parcelas tbody');

      tbody.html('');

      for (var i = 1; i <= numParcelas; i++) {
        var dataParcela = new Date();
        dataParcela.setMonth(dataParcela.getMonth() + i);

        var html = '<tr>' +
          '<td>' + i + '</td>' +
          '<td>' + dataParcela.toLocaleDateString() + '</td>' +
          '<td>' + valorParcela.toLocaleString('pt-BR', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
          }) + '</td>' +
          '<td><input type="text" class="form-control" name="observacoes[]" /></td>' +
          '</tr>';

        tbody.append(html);
      }

      $('#parcelas').show();
    } else {
      $('#parcelas').hide();
    }
  }

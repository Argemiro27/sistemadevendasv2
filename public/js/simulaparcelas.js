$(document).ready(function() {
    // Mostra parcelas
    $('#forma_pagamento').change(function() {
      if ($(this).val() === 'parcelado') {
        $('#parcelado-container').show();
      } else {
        $('#parcelado-container').hide();
      }
    });

    // Cria parcelas
    $('#num_parcelas').change(function() {
      simulaparcelas();
    });

});

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

  $( function() {
    $( "#cliente" ).autocomplete({
      source: function( request, response ) {
        $.ajax({
          url: "{{ route('clientes.autocomplete') }}",
          dataType: "json",
          data: {
            term: request.term
          },
          success: function( data ) {
            response( data );
          }
        });
      },
      minLength: 2
    });
  } );


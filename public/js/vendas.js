$(document).ready(function() {

    // Adicionar novo item
    $('#adicionar-item').click(function() {
      var html = '<div class="row mb-2">' +
        '<div class="col">' +
        '<input type="text" class="form-control item" name="item[]" required>' +
        '</div>' +
        '<div class="col">' +
        '<input type="number" class="form-control valor" name="valor[]" required>' +
        '</div>' +
        '<div class="col">' +
        '<button type="button" class="btn btn-danger remover-item">&times;</button>' +
        '</div>' +
        '</div>';

      $('#itens-container').append(html);
    });

    // Remover
    $(document).on('click', '.remover-item', function() {
      $(this).closest('.row').remove();
      calculaTotal();
    });

    // Soma
    $(document).on('change', '.valor', function() {
      calculaTotal();
    });

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

    // Função para calcular o total
    function calculaTotal() {
      var total = 0;
      $('.valor').each(function() {
        total += parseFloat($(this).val());
      });

      $('#total').val(total.toLocaleString('pt-BR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      }));
    }
  });

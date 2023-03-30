$(document).ready(function() {
    var produtos = [];

    $('#adicionar').click(function() {
      var produto_id = $('#produto').val();
      var produto_nome = $('#produto option:selected').text();
      var produto_quantidade = $('#quantidade').val();
      var produto_preco = $('#produto option:selected').data('preco');
      var produto_total = produto_quantidade * produto_preco;

      var item = {
        id: produto_id,
        nome: produto_nome,
        quantidade: produto_quantidade,
        preco: produto_preco,
        total: produto_total
      };

      produtos.push(item);
      renderizarCarrinho();
      limparCampos();
    });

    function renderizarCarrinho() {
      var total = 0;
      var tabela = '';
      for (var i = 0; i < produtos.length; i++) {
        tabela += '<tr>';
        tabela += '<td>' + produtos[i].nome + '</td>';
        tabela += '<td>' + produtos[i].quantidade + '</td>';
        tabela += '<td>' + produtos[i].preco + '</td>';
        tabela += '<td>' + produtos[i].total + '</td>';
        tabela += '</tr>';
        total += produtos[i].total;
      }
      $('#produtos-carrinho').html(tabela);
      $('#total').val(total);
    }

    function limparCampos() {
      $('#produto').val('');
      $('#quantidade').val('1');
    }

    $('#forma_pagamento').change(function() {
      if ($(this).val() == 'parcelado') {
        $('#parcelado-campo').show();
      } else {
        $('#parcelado-campo').hide();
      }
    });
  });

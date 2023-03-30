$(function () {
    $("#cliente_nome")
        .autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "/clientes/buscar",
                    dataType: "json",
                    data: {
                        termo: request.term,
                    },
                    success: function (data) {
                        response(data);
                    },
                });
            },
            messages: null,
            select: function (event, ui) {
                $("#cliente_id").val(ui.item.id);
                $("#cliente_nome").val(ui.item.nome);
                return false;
            },
        })

        .autocomplete("instance")._renderItem = function (ul, item) {
        return $("<li>")
            .append("<div>" + item.nome + "</div>")
            .appendTo(ul);

    };
});

const searchField = document.querySelector('#search-field');
const results = document.querySelector('#search-results');

// Adicione um evento de clique nos resultados
results.addEventListener('click', (event) => {
  // Verifique se o clique foi em um resultado
  if (event.target.classList.contains('result')) {
    // Se sim, esconda o campo de busca
    searchField.style.display = 'none';
  }
});

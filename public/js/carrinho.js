// pega a tabela de produtos
const tabelaProdutos = document.querySelector("tbody");

// pega o campo de total
const campoTotal = document.getElementById("total");

// cria um objeto para armazenar o valor total de cada produto
const valoresTotais = {};

// percorre cada linha da tabela de produtos
tabelaProdutos.querySelectorAll("tr").forEach(function (linha) {
    // pega o id e o valor unitário do produto
    const id = linha.querySelector("td:first-child").textContent;
    const valorUnitario = linha.querySelector("td:nth-child(4)").textContent;

    // pega o campo de quantidade do produto
    const campoQuantidade = linha.querySelector("input");

    // adiciona um listener para o campo de quantidade
    campoQuantidade.addEventListener("input", function () {
        // calcula o valor total do produto e armazena no objeto de valores totais
        const quantidade = this.value;
        const valorTotal = quantidade * valorUnitario;
        valoresTotais[id] = valorTotal;

        // calcula o valor total da compra
        let valorTotalCompra = 0;
        for (const idProduto in valoresTotais) {
            valorTotalCompra += valoresTotais[idProduto];
        }

        // atualiza o campo de total
        campoTotal.value = valorTotalCompra.toFixed(2);
    });
});

const produtos = document.querySelectorAll('.produto-quantidade');

produtos.forEach(produto => {
    produto.addEventListener('change', () => {
        let total = 0;
        produtos.forEach(produto => {
            total += produto.value * parseFloat(produto.parentNode.previousElementSibling.textContent.replace('R$ ', '').replace(',', '.'));
        });
        document.querySelector('#total').value = `R$ ${total.toFixed(2).replace('.', ',')}`;
    });
});

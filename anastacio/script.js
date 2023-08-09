function editarQuantidadeProduto() {
    // Obter o ID e a nova quantidade do produto do formulário do modal
    var productId = $("#productListEditQuantity").val();
    var newQuantity = $("#editProductQuantityValue").val();

    // Criar um objeto para enviar os dados via AJAX
    var data = {
        id: productId,
        quantidade: newQuantity
    };

    // Enviar os dados para o servidor através de uma requisição PUT
    $.ajax({
        url: 'http://localhost/nioaque/editar_quantidade_produto.php',
        type: 'PUT', // Alterado para PUT
        dataType: 'json',
        data: JSON.stringify(data),
        contentType: 'application/json',
        success: function(response) {
            // Verificar a resposta do servidor
            if (response.success) {
                // A quantidade do produto foi atualizada com sucesso
                alert(response.message);
                // Faça aqui o que for necessário, como atualizar a quantidade na lista de produtos na tela, etc.
            } else {
                // Ocorreu algum erro ao atualizar a quantidade do produto
                alert(response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("Erro na requisição:", error);
        }
    });
}

// Função para preencher a lista de produtos no modal (deve ser chamada antes de exibir o modal)
function fillProductList() {
    // Enviar uma requisição GET para obter a lista de produtos do servidor
    $.get('obter_produtos.php', function(response) {
        if (Array.isArray(response)) {
            // Limpar a lista atual
            $("#productListEditQuantity").empty();

            // Preencher a lista de produtos com as opções
            response.forEach(function(product) {
                var option = $("<option>")
                    .val(product.id)
                    .text(product.nome);
                $("#productListEditQuantity").append(option);
            });
        } else {
            console.error("Resposta inválida do servidor:", response);
        }
    })
    .fail(function(xhr, status, error) {
        console.error("Erro na requisição GET:", error);
    });
}

// Chamar a função para preencher a lista de produtos ao carregar a página
$(document).ready(function() {
    fillProductList();
});

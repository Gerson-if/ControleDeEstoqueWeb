<!DOCTYPE html>
<html>

<head>
    <title>Gerenciador de Produtos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="stely.css">
</head>

<body style="background-image: url('fundo3.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; background-color: transparent;">
    <div class="container mt-5">
        <h1>Gerenciador de Produtos</h1>

        <!-- Botão para adicionar produto -->
        <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#addProductModal">Adicionar Produto</button>

        <!-- Botão para editar produto -->
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#editProductModal">Editar Produto</button>

        <!-- Botão para remover produto -->
        <button type="button" class="btn btn-danger mb-3" data-toggle="modal" data-target="#removeProductModal">Remover Produto</button>

            
        <!-- Botão para editar a quantidade do produto -->
        <button type="button" class="btn btn-warning mb-3" data-toggle="modal" data-target="#editQuantityModal">Editar Quantidade do Produto</button>

        <!-- Barra de pesquisa -->
        <div class="input-group mb-3 justify-content-end">
            <input type="text" id="searchInput" class="form-control" placeholder="Pesquisar produto...">
            <div class="input-group-append">
                <button type="button" onclick="searchProducts()" class="btn btn-primary">Buscar</button>
            </div>
        </div>

        <!-- Grade de produtos -->
        <div class="product-grid">
            <!-- Lista de produtos será preenchida dinamicamente -->
        </div>
    </div>

    <!-- Modal de adicionar produto -->
    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Adicionar Produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="newProductName">Nome do Produto</label>
                        <input type="text" class="form-control" id="newProductName" required>
                    </div>
                    <div class="form-group">
                        <label for="newProductQuantity">Quantidade</label>
                        <input type="number" class="form-control" id="newProductQuantity" required>
                    </div>
                    <div class="form-group">
                        <label for="newProductImageURL">URL da Imagem</label>
                        <input type="text" class="form-control" id="newProductImageURL">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="addProduct()">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de editar produto -->
    <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Editar Produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="productList">Selecione o Produto:</label>
                        <select class="form-control" id="productList" onchange="loadEditFormData()">
                            <option value="-1">Selecione um produto...</option>
                            <!-- Lista de produtos será preenchida dinamicamente -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editProductName">Nome do Produto</label>
                        <input type="text" class="form-control" id="editProductName" required>
                    </div>
                    <div class="form-group">
                        <label for="editProductQuantity">Quantidade</label>
                        <input type="number" class="form-control" id="editProductQuantity" required>
                    </div>
                    <div class="form-group">
                        <label for="editProductImageURL">URL da Imagem</label>
                        <input type="text" class="form-control" id="editProductImageURL">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="editProduct()">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de remover produto -->
    <div class="modal fade" id="removeProductModal" tabindex="-1" role="dialog" aria-labelledby="removeProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="removeProductModalLabel">Remover Produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="productListRemove">Selecione o Produto:</label>
                        <select multiple class="form-control" id="productListRemove">
                            <!-- Lista de produtos será preenchida dinamicamente -->
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" onclick="removeProduct()">Remover</button>
                </div>
            </div>
        </div>
    </div>

   <!-- Modal de editar a quantidade do produto -->
    <div class="modal fade" id="editQuantityModal" tabindex="-1" role="dialog" aria-labelledby="editQuantityModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editQuantityModalLabel">Editar Quantidade do Produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="productListEditQuantity">Selecione o Produto:</label>
                        <select class="form-control" id="productListEditQuantity">
                            <!-- Lista de produtos será preenchida dinamicamente -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editProductQuantityValue">Nova Quantidade</label>
                        <input type="number" class="form-control" id="editProductQuantityValue" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="editarQuantidadeProduto()">Salvar</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="app.js"></script>
    
     <!-- Importe o arquivo jQuery antes do script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Importe o arquivo JavaScript com as funções necessárias -->
    <script src="script.js"></script>

</body>

</html>

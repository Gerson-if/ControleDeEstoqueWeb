const apiUrl = "database.php";

let productList = [];

function loadProducts() {
    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            productList = data;
            const productGrid = document.querySelector(".product-grid");
            productGrid.innerHTML = "";

            productList.forEach((product) => {
                const productCard = document.createElement("div");
                productCard.classList.add("card", "mb-3");

                //Adicionando o atributo "data-product-id" ao productCard
                productCard.setAttribute("data-product-id", product.id);

                const image = document.createElement("img");
                image.src = product.imagem || "placeholder-image.jpg";
                image.classList.add("card-img-top");

                const cardBody = document.createElement("div");
                cardBody.classList.add("card-body");

                const productName = document.createElement("h5");
                productName.classList.add("card-title");
                productName.textContent = product.nome;
            
                // Crie o elemento quantityContainer
                const quantityContainer = document.createElement("div");
                quantityContainer.classList.add("quantity-container");

                const increaseButton = document.createElement("button");
                increaseButton.textContent = "+";
                increaseButton.classList.add("quantity-button", "increase-button");
                increaseButton.addEventListener("click", () => increaseQuantity(product));

                const decreaseButton = document.createElement("button");
                decreaseButton.textContent = "-";
                decreaseButton.classList.add("quantity-button", "decrease-button");
                decreaseButton.addEventListener("click", () => decreaseQuantity(product));
                
               
                // Adicione os botões e a quantidadeDisplay ao quantityContainer
                quantityContainer.appendChild(decreaseButton);
               
                quantityContainer.appendChild(increaseButton);

                const productQuantity = document.createElement("p");
                productQuantity.classList.add("card-text");
                productQuantity.textContent = `Quantidade: ${product.quantidade}`;

                cardBody.appendChild(productName);
                cardBody.appendChild(productQuantity);

                // Adicione o quantityContainer ao cardBody
                cardBody.appendChild(quantityContainer);

                productCard.appendChild(image);
                productCard.appendChild(cardBody);
                productGrid.appendChild(productCard);
               
                // metodos raiz
                cardBody.appendChild(productName);
                cardBody.appendChild(productQuantity);
                productCard.appendChild(image);
                productCard.appendChild(cardBody);
                productGrid.appendChild(productCard);
            });
        })
        .catch(error => console.error("Error fetching products:", error));
}

function addProduct() {
    const newProductName = document.getElementById("newProductName").value;
    const newProductQuantity = parseInt(document.getElementById("newProductQuantity").value, 10);
    const newProductImageURL = document.getElementById("newProductImageURL").value;

    if (!newProductName ) {
       Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: 'Por favor, preencha todos os campos corretamente.'
        });
        return;
    }

    if (productList.some((product) => product.nome === newProductName)) {
        
        Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: 'Este produto já existe na lista.'
        });

        return;
    }

    const newProduct = {
        nome: newProductName,
        quantidade: newProductQuantity,
        imagem: newProductImageURL,
    };

    fetch(apiUrl, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(newProduct),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                productList.push(data.product);
                loadProducts();
                loadEditFormList();
                loadRemoveFormList();
                  
                  // aviso resposivo de sucesso
                   Swal.fire({
                    icon: 'success',
                    title: 'Sucesso',
                    text: 'Produto adicionado com sucesso!'
                });

                document.getElementById("newProductName").value = "";
                document.getElementById("newProductQuantity").value = "";
                document.getElementById("newProductImageURL").value = "";

                $("#addProductModal").modal("hide");
            } else {

                Swal.fire({
                    icon: 'success',
                    title: 'Erro',
                    text: 'sucesso'
                });
            }
        })
        // ultima modificação
     .catch(error => {
        Swal.fire({
            icon: 'success',
            title: 'Sucesso',
            text: 'sucesso'
        });

        console.error("Error adding product:", error);
    });
}

function loadEditFormList() {
    const productListSelect = document.getElementById("productList");
    productListSelect.innerHTML = '<option value="-1">Selecione um produto...</option>';

    // Fazer uma chamada de API para obter os dados dos produtos do servidor local
    fetch('http://localhost/sidrolandia/database.php')
      .then(response => response.json())
      .then(data => {
        data.forEach((product) => {
          const option = document.createElement("option");
          option.value = product.id;
          option.textContent = product.nome;
          productListSelect.appendChild(option);
        });
      })
      .catch(error => {
        console.error('Erro ao obter os dados dos produtos:', error);
      });
}

function loadEditFormData() {
    const productId = parseInt(document.getElementById("productList").value, 10);

    if (productId === -1) {
        document.getElementById("editProductName").value = "";
        document.getElementById("editProductQuantity").value = "";
        document.getElementById("editProductImageURL").value = "";
        return;
    }

    const product = productList.find((p) => p.id === productId);
    document.getElementById("editProductName").value = product.nome;
    document.getElementById("editProductQuantity").value = product.quantidade;
    document.getElementById("editProductImageURL").value = product.imagem;
}

function editProduct() {
    const productId = parseInt(document.getElementById("productList").value, 10);

    if (productId === -1) {

        Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: 'Por favor selecione um produto para editar'
        });

        return;
    }

    const editProductName = document.getElementById("editProductName").value;
    const editProductQuantity = parseInt(document.getElementById("editProductQuantity").value, 10);
    const editProductImageURL = document.getElementById("editProductImageURL").value;

    if (!editProductName) {

          Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: 'Por favor, preencha todos os campos corretamente.'
        });

        return;
    }

    if (productList.some((product) => product.id !== productId && product.nome === editProductName)) {

        Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: 'Já existe um produto com este nome.'
        });
        return;
    }

    const productIndex = productList.findIndex((p) => p.id === productId);

    const updatedProduct = {
        id: productId,
        nome: editProductName,
        quantidade: editProductQuantity,
        imagem: editProductImageURL,
    };

    fetch(apiUrl, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(updatedProduct),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                productList[productIndex] = updatedProduct;
                loadProducts();
                loadRemoveFormList();
                alert("Produto editado com sucesso!");

                $("#editProductModal").modal("hide");
            } else {

            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'Erro ao editar o produto.'
            });
                
            }
        })
        .catch(error => console.error("Error editing product:", error));
}

function loadRemoveFormList() {
    const productListRemoveSelect = document.getElementById("productListRemove");
    productListRemoveSelect.innerHTML = "";

    fetch('http://localhost/sidrolandia/database.php') // Substitua a URL pela correta
        .then(response => response.json())
        .then(data => {
            data.forEach((product) => {
                const option = document.createElement("option");
                option.value = product.id;
                option.textContent = product.nome;
                productListRemoveSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Erro ao obter os dados dos produtos:', error);
        });
}

// remover produtos 
function removeProduct() {
    const selectedProducts = Array.from(document.getElementById("productListRemove").selectedOptions);
    if (selectedProducts.length === 0) {
        alert("Selecione ao menos um produto para remover.");
        return;
    }

    const productIdsToRemove = selectedProducts.map((option) => parseInt(option.value, 10));

    fetch('http://localhost/sidrolandia/database.php', { // Substitua a URL pela correta
        method: "DELETE", // Use o método DELETE para enviar os IDs dos produtos a serem removidos
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(productIdsToRemove),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Atualize a lista de produtos localmente após a exclusão bem-sucedida
                productList = productList.filter((product) => !productIdsToRemove.includes(product.id));

                // Recarregue as listas de seleção e outros elementos na página
                loadEditFormList();
                loadRemoveFormList(); // Certifique-se de que a função loadEditFormList também está implementada
                loadProducts(); // Certifique-se de que a função loadProducts também está implementada

                alert("Produto(s) removido(s) com sucesso!");
            } else {
                alert("Erro ao remover o(s) produto(s).");
            }
        })
        .catch(error => console.error("Error removing product:", error));
}

//----------------------------------------------------------------------
function increaseQuantity(product) {
    if (!isNaN(product.quantidade)) {
        product.quantidade = parseInt(product.quantidade, 10) + 1;
        updateProductQuantity(product);
        updateQuantityInDatabase(product);
    }
}

function decreaseQuantity(product) {
    if (!isNaN(product.quantidade)) {
        product.quantidade = parseInt(product.quantidade, 10) - 1;
        if (product.quantidade < 0) {
            product.quantidade = 0;
        }
        updateProductQuantity(product);
        updateQuantityInDatabase(product);
    }
}

function updateProductQuantity(product) {
    const quantityDisplay = document.querySelector(`[data-product-id="${product.id}"] .card-text`);
    if (quantityDisplay) {
        quantityDisplay.textContent = `Quantidade: ${product.quantidade}`;
    }
}

function updateQuantityInDatabase(product) {
    // Fazer uma chamada para atualizar a quantidade do produto no banco de dados
    fetch(apiUrl, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json",
        },
        //body: JSON.stringify({ id: product.id, quantidade: product.quantidade }),
        body: JSON.stringify(product), // Certifique-se de que o objeto do produto inclua o ID e a nova quantidade
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log("Quantidade do produto atualizada no banco de dados.");
            updateProductQuantity(product); //Chamando a função depois de atualizar os dados do banco
        } else {
            console.error("Erro ao atualizar a quantidade do produto no banco de dados.");
        }
    })
    .catch(error => console.error("Error updating product quantity in the database:", error));
}

//----------------------------------------------------------------------


// Carregue a lista de produtos ao carregar a página
document.addEventListener("DOMContentLoaded", () => {
    loadProducts();
    loadEditFormList();
    loadRemoveFormList();
});

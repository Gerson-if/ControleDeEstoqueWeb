<?php

// Conexão com o banco de dados (substitua as informações pelas suas configurações)
$servername = "localhost:3306";
$username = "root";
$password = "root";
$dbname = "loja";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem sucedida
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Configurações do cabeçalho HTTP para permitir requisições cross-origin (CORS)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, OPTIONS"); // Adicionad

// Verifica o método da requisição
$method = $_SERVER["REQUEST_METHOD"];

// Se a requisição for do tipo PUT
if ($method === "PUT") {
    // Recebe os dados do produto atualizado do corpo da requisição
    $data = json_decode(file_get_contents("php://input"), true);

    // Verifica se os campos obrigatórios foram fornecidos
    if (empty($data["id"]) ) {
        // Retorna uma resposta com erro 400 (Bad Request) e uma mensagem de erro
        http_response_code(400);
        echo json_encode(array("success" => false, "message" => "Dados incompletos."));
        exit;
    }

    // Atualiza a quantidade do produto no banco de dados
    $sql = "UPDATE aquidauana SET quantidade = " . $data["quantidade"] . " WHERE id = " . $data["id"];
    if ($conn->query($sql) === TRUE) {
        // Retorna uma resposta com código 200 (OK) e uma mensagem de sucesso
        http_response_code(200);
        echo json_encode(array("success" => true, "message" => "Quantidade do produto atualizada com sucesso."));
    } else {
        // Retorna uma resposta com erro 500 (Internal Server Error) e uma mensagem de erro
        http_response_code(500);
        echo json_encode(array("success" => false, "message" => "Erro ao atualizar a quantidade do produto."));
    }
} else {
    // Se o método não for suportado
    // Retorna uma resposta com erro 405 (Method Not Allowed) e uma mensagem de erro
    http_response_code(405);
    echo json_encode(array("success" => false, "message" => "Método não suportado."));
}

$conn->close();
?>

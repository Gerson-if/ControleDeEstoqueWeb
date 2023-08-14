<?php
// Conexão com o banco de dados (substitua as informações pelas suas configurações)
$servername = "localhost";
$username = "root";
$password = "";
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
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");


// Verifica o método da requisição
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Consulta todos os produtos do banco de dados
    $sql = "SELECT * FROM jardim";
    $result = $conn->query($sql);

    $products = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }

    // Retorna os produtos como JSON
    echo json_encode($products);
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recebe os dados do novo produto do corpo da requisição
    $data = json_decode(file_get_contents("php://input"), true);

    // Verifica se os campos obrigatórios foram fornecidos
    if (empty($data["nome"]) ) {
        echo json_encode(array("success" => false));
        exit;
    }

    // Insere o novo produto no banco de dados
    $sql = "INSERT INTO jardim (nome, quantidade, imagem) VALUES ('" . $data["nome"] . "', " . $data["quantidade"] . ", '" . $data["imagem"] . "')";
    if ($conn->query($sql) === TRUE) {
        $data["id"] = $conn->insert_id;
        echo json_encode(array("success" => true, "product" => $data));
    } else {
        echo json_encode(array("success" => false));
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "PUT") {
    // Recebe os dados do produto atualizado do corpo da requisição
    $data = json_decode(file_get_contents("php://input"), true);

    // Verifica se os campos obrigatórios foram fornecidos
    if (empty($data["id"]) || empty($data["nome"]) ) {
        echo json_encode(array("success" => false));
        exit;
    }

    // Atualiza o produto no banco de dados
    $sql = "UPDATE jardim SET nome='" . $data["nome"] . "', quantidade=" . $data["quantidade"] . ", imagem='" . $data["imagem"] . "' WHERE id=" . $data["id"];
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("success" => false));
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    // Recebe os IDs dos produtos a serem removidos do corpo da requisição
    $data = json_decode(file_get_contents("php://input"), true);

    // Verifica se foram fornecidos IDs válidos
    if (!is_array($data) || empty($data)) {
        echo json_encode(array("success" => false));
        exit;
    }

    // Formata os IDs em uma string para a consulta
    $ids = implode(",", $data);

    // Remove os produtos do banco de dados
    $sql = "DELETE FROM jardim WHERE id IN ($ids)";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("success" => false));
    }
}

$conn->close();
?>

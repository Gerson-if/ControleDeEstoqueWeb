<?php
// esse arquivo e da 
// Conexão com o banco de dados (substitua as informações pelas suas configurações)
$servername = "localhost:3306";
$username = "root"; // substitua pelo nome de usuário do seu banco de dados
$password = "root"; // substitua pela senha do seu banco de dados
$dbname = "loja";

$conn = new mysqli($servername, $username, $password, $dbname);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, OPTIONS"); // Adicionad

// Verifica se a conexão foi bem sucedida
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Configurações do cabeçalho HTTP para permitir requisições cross-origin (CORS)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

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

$conn->close();
?>

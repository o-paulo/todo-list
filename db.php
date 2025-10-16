<?php

// 1. Carrega o autoload do Composer para ter acesso à biblioteca
require_once __DIR__ . '/vendor/autoload.php';

// 2. Cria uma instância do Dotenv e carrega as variáveis do arquivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Configurações e conexão com o banco de dados
$servername = $_ENV['DB_HOST'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASSWORD'];
$dbname = $_ENV['DB_NAME'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Lógica de processamento do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $titulo = $_POST["titulo"] ?? "";
    $descricao = $_POST["descricao"] ?? "";

    $stmt = $conn->prepare("INSERT INTO tarefas (titulo, descricao) VALUES (?, ?)");
    $stmt->bind_param("ss", $titulo, $descricao);

    // Se a query for executada com sucesso
    if ($stmt->execute()) {
        $_SESSION['tarefa_criada_sucesso'] = true;
        $_SESSION['titulo'] = $titulo;
    }

    $stmt->close();
    $conn->close();

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
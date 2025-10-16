<?php

// 1. Carrega o autoload do Composer para ter acesso à biblioteca
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// 3. Lê as variáveis de ambiente para a conexão
$servername = $_ENV['DB_HOST'];
$username   = $_ENV['DB_USER'];
$password   = $_ENV['DB_PASSWORD'];
$dbname     = $_ENV['DB_NAME'];

// 4. Cria a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// 5. Verifica se houve erro na conexão
if ($conn->connect_error) {
    // A função die() interrompe a execução do script e exibe uma mensagem.
    // É crucial para não continuar se a conexão falhar.
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// 6. Retorna o objeto de conexão para ser usado em outros arquivos
return $conn;
<?php

$conn = require_once __DIR__ . '/database.php';

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
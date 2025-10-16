<?php

// index.php

session_start();

// Inclui a conexão com o banco de dados
$conn = require_once __DIR__ . '/database.php';
// Inclui as funções do modelo de tarefas
require_once __DIR__ . '/model_tarefas.php';


// --- PARTE CONTROLADORA ---
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Pega os dados do formulário
    $titulo = $_POST["titulo"] ?? "";
    $descricao = $_POST["descricao"] ?? "";

    // 2. Chama a função do modelo para inserir os dados
    $sucesso = criarTarefa($conn, $titulo, $descricao);

    // 3. Prepara a resposta para o usuário (o toast)
    if ($sucesso) {
        $_SESSION['tarefa_criada_sucesso'] = true;
        $_SESSION['ultima_tarefa_titulo'] = $titulo;
    }

    // 4. Fecha a conexão e redireciona
    $conn->close();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="grid text-center">
        <h1 class="page-title">Todo List</h1>

        <form class="container" action="index.php" method="POST">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título da tarefa</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required placeholder="Digite o titulo da tarefa">
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição da tarefa</label>
                <textarea class="form-control" placeholder="Descreva sua tarefa" id="descricao" name="descricao" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary g-col-4">Criar tarefa</button>
        </form>

        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Sucesso</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    A tarefa "<strong><?= htmlspecialchars($_SESSION['ultima_tarefa_titulo'] ?? 'Nova Tarefa') ?></strong>" foi criada com sucesso!
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        <?php
        if (isset($_SESSION['tarefa_criada_sucesso']) && $_SESSION['tarefa_criada_sucesso']) {
            echo "
                const toastLiveExample = document.getElementById('liveToast');
                const toast = new bootstrap.Toast(toastLiveExample);
                toast.show();
            ";
            
            unset($_SESSION['tarefa_criada_sucesso']);
            unset($_SESSION['ultima_tarefa_titulo']); // Limpando a variável de título também
        }
        ?>
    </script>

</body>
</html>
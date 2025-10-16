<?php
session_start();

include "db.php";
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

        <form class="container" action="" method="POST">
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
                    A tarefa "<strong><?= htmlspecialchars($_SESSION['titulo'] ?? 'Nova Tarefa') ?></strong>" foi criada com sucesso!
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        <?php
        // Verifica se a nossa "bandeira" da sessão existe e é verdadeira
        if (isset($_SESSION['tarefa_criada_sucesso']) && $_SESSION['tarefa_criada_sucesso']) {
            // Se sim, executa o JavaScript para mostrar o toast
            echo "
                const toastLiveExample = document.getElementById('liveToast');
                const toast = new bootstrap.Toast(toastLiveExample);
                toast.show();
            ";
            
            // Limpa a "bandeira" para que o toast não apareça novamente se o usuário atualizar a página
            unset($_SESSION['tarefa_criada_sucesso']);
        }
        ?>
    </script>

</body>

</html>
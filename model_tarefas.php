<?php

// model_tarefas.php

/**
 * Insere uma nova tarefa no banco de dados.
 *
 * @param mysqli $conn O objeto de conexão com o banco de dados.
 * @param string $titulo O título da tarefa.
 * @param string $descricao A descrição da tarefa.
 * @return bool Retorna true se a inserção for bem-sucedida, false caso contrário.
 */

function criarTarefa(mysqli $conn, string $titulo, string $descricao): bool
{
    $stmt = $conn->prepare("INSERT INTO tarefas (titulo, descricao) VALUES (?, ?)");
    $stmt->bind_param("ss", $titulo, $descricao);
    
    $resultado = $stmt->execute();
    
    $stmt->close();
    
    return $resultado;
}

/**
 * Insere uma nova tarefa no banco de dados.
 *
 * @param mysqli $conn O objeto de conexão com o banco de dados.
 * @param string $titulo O título da tarefa.
 * @param string $descricao A descrição da tarefa.
 * @param string $data_criacao A data que a tarefa foi criada.
 * @return bool Retorna true se a busca for bem-sucedida, false caso contrário.
 */

function buscarTarefas(mysqli $conn , string $titulo, string $descricao, string $data_criacao): bool{
    $stmt = $conn->prepare("SELECT * FROM tarefas");
    $stmt->bind_param("sss", $titulo, $descricao, $data_criacao);
    
    $tarefasEncontradas = $stmt->execute();

    $stmt->close();

    return $tarefasEncontradas;
}
<?php
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $paciente_id = $_POST["paciente_id"];
    $procedimento_id = $_POST["procedimento_id"];
    $data_hora = $_POST["data_hora"];
    $observacoes = $_POST["observacoes"];

    // Verificar se já existe uma consulta agendada para o mesmo dia e horário
    $sql_verificar = "SELECT COUNT(*) AS total FROM consultas WHERE data_hora = ?";
    $stmt_verificar = $conexao->prepare($sql_verificar);
    $stmt_verificar->bind_param("s", $data_hora);
    $stmt_verificar->execute();
    $resultado_verificar = $stmt_verificar->get_result();
    $row_verificar = $resultado_verificar->fetch_assoc();

    if ($row_verificar["total"] > 0) {
        // Já existe uma consulta agendada no mesmo dia e horário
        die("Já existe uma consulta agendada para o mesmo dia e horário.");
    } else {
        // Calcular a data e hora de término da consulta (1 hora após a data e hora de início)
        $data_hora_termino = date("Y-m-d H:i:s", strtotime($data_hora . "+1 hour"));

        // Prepara e executa o agendamento da consulta na tabela
        $sql_agendar = "INSERT INTO consultas (paciente_id, procedimento_id, data_hora, data_hora_termino, observacoes)
                        VALUES (?, ?, ?, ?, ?)";
        $stmt_agendar = $conexao->prepare($sql_agendar);
        $stmt_agendar->bind_param("iisss", $paciente_id, $procedimento_id, $data_hora, $data_hora_termino, $observacoes);

        // Executa o agendamento
        if ($stmt_agendar->execute()) {
            // Redireciona para a página de consultas
            header("Location: consultas.php");
            exit;
        } else {
            // Caso ocorra algum erro, exibe a mensagem de erro
            die("Erro ao agendar consulta: " . $stmt_agendar->error);
        }
    }
}
?>

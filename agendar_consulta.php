<?php
    include "conexao.php";
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $paciente_id = $_POST["paciente_id"];
        $procedimento_id = $_POST["procedimento_id"];
        $data_hora = $_POST["data_hora"];
        $observacoes = $_POST["observacoes"];

        // Verificar se já existe uma consulta na mesma data e horário
        $sql_verificar_consulta = "SELECT COUNT(*) FROM consultas WHERE data_hora = :data_hora";
        $stmt_verificar_consulta = $conexao->prepare($sql_verificar_consulta);
        $stmt_verificar_consulta->bindParam(':data_hora', $data_hora);
        $stmt_verificar_consulta->execute();
        $consulta_existente = $stmt_verificar_consulta->fetchColumn();

        if ($consulta_existente > 0) {
            // Exibe um alerta com a mensagem de erro
            echo "<script>alert('Já existe uma consulta agendada para a mesma data e horário. Por favor, escolha outra data/horário.');</script>";
        } else {
            // Inserir consulta no banco de dados
            $sql_inserir_consulta = "INSERT INTO consultas (paciente_id, procedimento_id, data_hora, observacoes) VALUES (:paciente_id, :procedimento_id, :data_hora, :observacoes)";
            $stmt_inserir_consulta = $conexao->prepare($sql_inserir_consulta);
            $stmt_inserir_consulta->bindParam(':paciente_id', $paciente_id);
            $stmt_inserir_consulta->bindParam(':procedimento_id', $procedimento_id);
            $stmt_inserir_consulta->bindParam(':data_hora', $data_hora);
            $stmt_inserir_consulta->bindParam(':observacoes', $observacoes);

            if ($stmt_inserir_consulta->execute()) {
                // Redireciona para a página de consultas após 1 segundo
                echo "<script>alert('Consulta agendada com sucesso.'); setTimeout(function() { window.location.href = 'consultas.php'; }, 1000);</script>";
                exit;
            } else {
                echo "Erro ao agendar a consulta. Por favor, tente novamente.";
            }
        }
    }

    // Consulta para obter os pacientes cadastrados com nível de acesso igual a 0 (funcionários)
    $sql_pacientes = "SELECT id, nome FROM pacientes";
    $stmt_pacientes = $conexao->query($sql_pacientes);

    // Consulta para obter os procedimentos cadastrados
    $sql_procedimentos = "SELECT id, nome_procedimento FROM procedimentos";
    $stmt_procedimentos = $conexao->query($sql_procedimentos);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Clínica Odontológica - Agendar Consulta</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <h1>Agendar Consulta</h1>
    <form action="agendar_consulta.php" method="post">
        <label for="paciente_id">Selecione o Paciente:</label>
        <select id="paciente_id" name="paciente_id" required>
            <?php
            // Exibição dos pacientes em um menu suspenso
            while ($row_paciente = $stmt_pacientes->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $row_paciente['id'] . "'>" . $row_paciente['nome'] . "</option>";
            }
            ?>
        </select><br>

        <label for="procedimento_id">Selecione o Procedimento:</label>
        <select id="procedimento_id" name="procedimento_id" required>
            <?php
            // Exibição dos procedimentos em um menu suspenso
            while ($row_procedimento = $stmt_procedimentos->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $row_procedimento['id'] . "'>" . $row_procedimento['nome_procedimento'] . "</option>";
            }
            ?>
        </select><br>

        <label for="data_hora">Data e Hora da Consulta:</label>
        <input type="datetime-local" id="data_hora" name="data_hora" required><br>

        <label for="observacoes">Observações:</label>
        <textarea id="observacoes" name="observacoes" rows="4" cols="50"></textarea><br>

        <input type="submit" value="Agendar Consulta">
        <button class="bt" onclick="window.location.href = 'funcionario.php'">Voltar</button>
    </form>
</body>
</html>

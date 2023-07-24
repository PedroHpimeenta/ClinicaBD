<!DOCTYPE html>
<?php
include "conexao.php";
?>

<html>
<head>
    <title>Clínica Odontológica</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <h1>Consultas Agendadas</h1>

    <table>
        <tr>
            <th>Nome do Paciente</th>
            <th>Procedimento</th>
            <th>Data e Hora</th>
            <th>Observações</th>
        </tr>
        <?php
        // Consulta para obter as consultas agendadas
        $query = "SELECT c.id, p.nome, pr.nome_procedimento, c.data_hora, c.observacoes FROM consultas c
                  INNER JOIN pacientes p ON c.paciente_id = p.id
                  INNER JOIN procedimentos pr ON c.procedimento_id = pr.id";
        $stmt = $conexao->prepare($query);
        $stmt->execute();
        $consultas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Exibição das consultas em uma tabela
        foreach ($consultas as $consulta) {
            echo "<tr>";
            echo "<td>" . $consulta['nome'] . "</td>";
            echo "<td>" . $consulta['nome_procedimento'] . "</td>";
            echo "<td>" . $consulta['data_hora'] . "</td>";
            echo "<td>" . $consulta['observacoes'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <br>
    
    <button class="botoes" onclick="window.location.href='funcionario.php'">Voltar</button>
</body>
</html>

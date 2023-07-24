<!DOCTYPE html>
<html>
<head>
    <title>Histórico de Procedimentos</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <h1>Histórico de Procedimentos</h1>

    <?php
    // Incluir o arquivo de conexão com o banco de dados
    include "conexao.php";

    try {
        // Consulta para obter o histórico de procedimentos de cada paciente e o valor total gasto
        $query = "
            SELECT c.paciente_id, pac.nome AS nome_paciente, COUNT(*) AS total_procedimentos, SUM(p.preco) AS valor_total
            FROM consultas c
            INNER JOIN pacientes pac ON c.paciente_id = pac.id
            INNER JOIN procedimentos p ON c.procedimento_id = p.id
            GROUP BY c.paciente_id, pac.nome
            ORDER BY pac.nome
        ";

        $stmt = $conexao->prepare($query);
        $stmt->execute();
        $historico_procedimentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($historico_procedimentos) > 0) {
            echo "<table border='1'>
                    <tr>
                        <th>Paciente</th>
                        <th>Total de Procedimentos</th>
                        <th>Valor Total Gasto</th>
                    </tr>";

            foreach ($historico_procedimentos as $procedimento) {
                echo "<tr>
                        <td>" . $procedimento['nome_paciente'] . "</td>
                        <td>" . $procedimento['total_procedimentos'] . "</td>
                        <td>R$ " . $procedimento['valor_total'] . "</td>
                    </tr>";
            }

            echo "</table>";
        } else {
            echo "<p>Nenhum procedimento encontrado para pacientes.</p>";
        }
    } catch (PDOException $erro) {
        echo "Ocorreu um erro na consulta: " . $erro->getMessage();
    }
    ?>
     <button class="botoes" onclick="history.back()">Voltar</button>
</body>
</html>

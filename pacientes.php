<?php
include "conexao.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Clínica Odontológica</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <h1>Pacientes Cadastrados</h1>
    <table>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Endereço</th>
            <th>Telefone</th>
        </tr>
        <?php
        // Consulta para obter os pacientes cadastrados
        $query = "SELECT id, nome, email, endereco, telefone FROM pacientes";
        $stmt = $conexao->prepare($query);
        $stmt->execute();
        $pacientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Exibição dos pacientes em uma tabela
        foreach ($pacientes as $paciente) {
            echo "<tr>";
            echo "<td>" . $paciente['nome'] . "</td>";
            echo "<td>" . $paciente['email'] . "</td>";
            echo "<td>" . $paciente['endereco'] . "</td>";
            echo "<td>" . $paciente['telefone'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <button class="botoes" onclick="history.back()">Voltar</button>
</body>
</html>

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
    <h1>Funcionários Cadastrados</h1>

    <table>
        <tr>
            <th>Nome</th>
            <th>Email</th>
        </tr>
        <?php
        // Consulta para obter os funcionários cadastrados
        $query = "SELECT id, nome, email, nivel_acesso FROM usuarios WHERE nivel_acesso = 0";
        $stmt = $conexao->prepare($query); // Prepara a consulta
        $stmt->execute();  // Executa a consulta
        $funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC); //Armazena o resultado da consulta em um array usando o  fetchAll()

        // Exibição dos funcionários em uma tabela
        foreach ($funcionarios as $funcionario) {
            echo "<tr>";
            echo "<td>" . $funcionario['nome'] . "</td>";
            echo "<td>" . $funcionario['email'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <br>
    <button class="botoes" onclick="history.back()">Voltar</button>
</body>
</html>

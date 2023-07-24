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
    <h1>Cadastrar Paciente</h1>
    <form action="processa_cadastro_paciente.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br>

        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" required><br>

        <label for="endereco">Endereço:</label>
        <textarea id="endereco" name="endereco" rows="4" cols="50"></textarea><br>

        <input type="submit" value="Cadastrar Paciente">
        <button class="bt" onclick="window.location.href='funcionario.php'">Voltar</button>
    </form>
</body>
</html>

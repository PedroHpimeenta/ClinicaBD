<?php
session_start();
include "conexao.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Clínica Odontológica - Cadastrar Funcionário</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <h1>Cadastrar Funcionário</h1>
    <form action="cadastrar_funcionario.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" placeholder="Nome" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Email" required><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" placeholder="Senha" required><br>
        <br>
        <input type="submit" value="Cadastrar Funcionário">
        <button class="bt" onclick="window.location.href='administrador.php'">Voltar</button>
    </form>
</body>
</html>
<?php
session_start();
$nome = $_SESSION["usuario"][0];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Clínica Odontológica - Administrador</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <h1>Página do Administrador</h1>
    <p>Seja bem-vindo, <?php echo $nome; ?>  </p>
    <p> Esta é a página exclusiva para administradores.</p>
    <p>Aqui você pode realizar tarefas especiais.</p>

    
    <ul>
        <li><a class="botoes" href="cadastro_funcionario_form.php">Cadastrar Funcionários</a></li>
        <li><a class="botoes" href="mostrarfuncionarios.php">Visualizar Funcionários</a></li>
        <li><a class="botoes" href="excluirfuncionario.php">Remover Funcionários</a></li>
        <li><a class="botoes" href="editar_func.php">Editar Funcionário</a></li>
        <li><a class="botoes" href="logout.php">Sair</a></li>
    </ul>

</body>
</html>

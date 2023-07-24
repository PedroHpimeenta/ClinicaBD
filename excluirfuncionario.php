<?php
include "conexao.php";

// Verifica se o formulário de exclusão foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["excluir_funcionario"])) {
    $id_funcionario = $_POST["funcionario_id"];

    // Chama a stored procedure para excluir o funcionário
    $sql_excluir_funcionario = "call sp_excluir_funcionario(:id_funcionario)";
    $stmt_excluir_funcionario = $conexao->prepare($sql_excluir_funcionario);
    $stmt_excluir_funcionario->bindParam(':id_funcionario', $id_funcionario, PDO::PARAM_INT);
    
    // Executa a stored procedure
    if ($stmt_excluir_funcionario->execute()) {
        // Redireciona para a página de administrador após a exclusão
        echo '<script>alert("Operação realizada com sucesso!"); window.location = "excluirfuncionario.php";</script>';
        exit;
    } else {
        echo "Erro ao excluir o funcionário.";
    }
}

// Consulta para obter todos os funcionários cadastrados
$query = "SELECT id, nome, email FROM usuarios WHERE nivel_acesso = 0";
$stmt = $conexao->query($query);
$funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Excluir Funcionário</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <h1>Excluir Funcionário</h1>
    <form action="excluirfuncionario.php" method="post">
        <label for="funcionario_id">Selecione o Funcionário:</label>
        <select id="funcionario_id" name="funcionario_id">
            <?php foreach ($funcionarios as $funcionario) : ?>
                <option value="<?php echo $funcionario['id']; ?>">
                    <?php echo $funcionario['nome'] . " - " . $funcionario['email']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" name="excluir_funcionario" value="Excluir">
        <a class="botoes" href="administrador.php">Voltar</a>
    </form>
    <br>
   
</body>
</html>

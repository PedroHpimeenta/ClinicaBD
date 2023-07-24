<?php
include "conexao.php";

// Função para buscar os dados de um funcionário pelo ID
function getFuncionario($id_funcionario, $conexao)
{
    $query = "SELECT id, nome, email, senha FROM usuarios WHERE id = ?";
    $stmt = $conexao->prepare($query);
    $stmt->execute([$id_funcionario]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Verifica se o formulário de edição foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editar_funcionario"])) {
    $id_funcionario = $_POST["funcionario_id"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Atualiza os dados do funcionário no banco de dados
    $query = "UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE id = ?";
    $stmt = $conexao->prepare($query);
    $stmt->execute([$nome, $email, $senha, $id_funcionario]);

    // Exibe um alerta de sucesso e redireciona
    echo '<script>alert(" Operação realizada  com sucesso!"); window.location = "editar_func.php";</script>';
}

// Consulta para obter apenas os funcionários com nível de acesso igual a 0
$query = "SELECT id, nome, email FROM usuarios WHERE nivel_acesso = 0";
$stmt = $conexao->query($query);
$funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Funcionário</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <h1>Editar Funcionário</h1>
    <form action="editar_func.php" method="post">
        <label for="funcionario_id">Selecione o Funcionário:</label>
        
        <select id="funcionario_id" name="funcionario_id" onchange="this.form.submit()">
            <option value="">Selecione um funcionário</option>
            <?php foreach ($funcionarios as $funcionario) : ?>
                <option value="<?php echo $funcionario['id']; ?>"
                    <?php if (isset($_POST['funcionario_id']) && $_POST['funcionario_id'] == $funcionario['id']) echo 'selected'; ?>>
                    <?php echo $funcionario['nome'] . " - " . $funcionario['email']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <a style="margin-left:1000px; position: relative; bottom: 46px; right:1600px;" class="botoes" href="administrador.php">Voltar</a>

    </form>

    <?php
  
    if (isset($_POST['funcionario_id']) && !empty($_POST['funcionario_id'])) {
        $id_funcionario = $_POST['funcionario_id'];
        $funcionario = getFuncionario($id_funcionario, $conexao);
    ?>
        <form action="editar_func.php" method="post">
            <input type="hidden" name="funcionario_id" value="<?php echo $funcionario['id']; ?>">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo $funcionario['nome']; ?>" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $funcionario['email']; ?>" required><br>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" value="<?php echo $funcionario['senha']; ?>" required><br>
            <br>
            <input style="position: relative;  right:22px" class="botoes" type="submit" name="editar_funcionario" value="Salvar Alterações">
            
        </form>
    <?php } ?>
    <br>
    
</body>
</html>

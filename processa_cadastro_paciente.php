<?php
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $data_nascimento = $_POST["data_nascimento"];
    $endereco = $_POST["endereco"];

    // Verifica se o email já está cadastrado
    $sql_verificar = "SELECT COUNT(*) FROM pacientes WHERE email = :email";
    $stmt_verificar = $conexao->prepare($sql_verificar);
    $stmt_verificar->bindParam(":email", $email);
    $stmt_verificar->execute();
    $num_rows = $stmt_verificar->fetchColumn();

    if ($num_rows > 0) {
        echo '<script>alert("Este email já está cadastrado. Por favor, insira um email diferente."); window.location = "cadastrar_paciente.php";</script>';
        exit;
    }

    // Executa o procedure para cadastrar o paciente
    $stmt = $conexao->prepare("CALL sp_cadastrar_paciente(?, ?, ?, ?, ?)");
    $stmt->execute([$nome, $telefone, $email, $data_nascimento, $endereco]);

    // Redireciona para a página de clientes
    echo '<script>alert("Operação realizada com sucesso!"); window.location = "cadastrar_paciente.php";</script>';
    exit;
}
?>

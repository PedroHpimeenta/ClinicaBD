<?php
session_start();

// Verifica se o usuário está autenticado
$exibir_botao_login = true;
$exibir_painel_administrador = false;

if (isset($_SESSION["usuario_id"])) {
    $exibir_botao_login = false;
    if (isset($_SESSION["nivel_acesso"]) && $_SESSION["nivel_acesso"] == 1) {
        $exibir_painel_administrador = true;
        $nome_usuario = $_SESSION["nome"];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Clínica Odontológica</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <div class="container-login">
        <div class="img-box">
            <img src="img/2.png" alt="">
        </div>
        <div class="content-box">
            <div class="form-box">
                <h2>Login</h2>
            <form action="login.php" method="post">
                <div class="input-box">
                     <label for="email">Email:</label>
                     <input type="email" id="email" name="email" placeholder="Email" required><br>
                </div>
                <div class="input-box">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" placeholder="Senha" required><br>
                </div>
                    <div class="input-box">
                        <input type="submit" value="Entrar">
                    </div>
           

          
            <?php
            if (isset($erro_login)) {
                echo "<p class='erro-login'>$erro_login</p>";
            }
            ?>
    </form>
            </div>
        </div>
    </div>
</body>
</html>

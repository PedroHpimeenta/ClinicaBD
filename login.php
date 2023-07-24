<?php
session_start();

    require("conexao.php");

    if(isset($_POST["email"]) && isset($_POST["senha"]) && $conexao != null){
        $query = $conexao->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?");
        $query->execute(array($_POST["email"], $_POST["senha"]));

        if($query->rowCount()){
            $user = $query->fetchAll(PDO::FETCH_ASSOC)[0];

            
            $_SESSION["usuario"] = array($user["nome"], $user["nivel_acesso"], $user["id"]);
             if ($user["nivel_acesso"])   {
                echo "<script>window.location = 'administrador.php'</script>";
             } else {
                echo "<script>window.location = 'funcionario.php'</script>";
             }
             
            
        }else{
       
            echo "<script> alert('Senha incorreta!'); window.location = 'index.php'</script>";
        }
    }else{
        echo "<script>window.location = 'administrador.php'</script>";
    }
?>


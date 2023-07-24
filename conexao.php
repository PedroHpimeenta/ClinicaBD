<?php
    $server = "localhost";  // Endereço do servidor
    $usuario = "root"; // Usuario do bd
    $senha = "";
    $banco = "clinica"; // nome do bd

    try{
        // Tentativa de conexão com o banco de dados usando a classe PDO
        $conexao = new PDO("mysql:host=$server;dbname=$banco", $usuario, $senha);
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //tratamento de erros: lançar exceções em caso de erros
    }catch(PDOException $erro){
        echo "Ocorreu um erro de conexao: {$erro->getMessage()}";
        $conexao = null;
    }
?>
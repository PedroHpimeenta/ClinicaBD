<?php
session_start();


?>

<!DOCTYPE html>
<html>
<head>
    <title>Clínica Odontológica</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <h1>Bem-vindo à Clínica Odontológica</h1>
    
    <p>Este é um sistema para gerenciamento de pacientes e consultas.</p>

    <ul>
        <li><a class="botoes" href="cadastrar_paciente.php">Cadastrar Paciente</a></li>
        <li><a class="botoes" href="agendar_consulta.php">Agendar Consulta</a></li>
        <li><a class="botoes" href="pacientes.php">Visualizar Pacientes</a></li>
        <li><a class="botoes" href="consultas.php">Visualizar Consultas</a></li>
        <li><a class="botoes" href="historico_procedimentos">Historico</a></li>
        <li><a class="botoes" href="logout.php">Sair</a></li>
        
    </ul>
</body>
</html>

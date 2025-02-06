<?php
try {
    // Bloco try para tentar a conexão com o banco de dados
    $dbhost = 'localhost'; // Host do banco de dados
    $dbusername = 'root'; // Nome de usuário do banco de dados
    $dbpassword = 'root'; // Senha do banco de dados
    $dbname = 'crud_login'; // Nome do banco de dados

    // Criação da conexão PDO
    $conexao = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);
    
    // Configuramos o modo de erro do PDO para exceções
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Bloco catch para capturar exceções
    echo "Falha na Conexão: " . $e->getMessage();
    exit(); // Adicione esta linha para parar a execução se a conexão falhar
}
?>

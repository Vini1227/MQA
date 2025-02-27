<?php
try { // Bloco try para tentar a conexão com o banco de dados
    $dbhost = 'localhost';
    $dbusername = 'root';
    $dbpassword = 'root';
    $dbname = 'crud_login';

    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}   catch (PDOException $e) { // Bloco catch para capturar exceções
        echo "Falha na Conexão: " . $e->getMessage();
}
?>

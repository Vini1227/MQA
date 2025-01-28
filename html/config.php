<?php
    $dbhost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'crud_login';

    $conexao = new mysqli($dbhost, $dbUsername, $dbPassword, $dbName);

    //if ($conexao->connect_errno) {
    //    echo "Falha na Conexão";
    //} else {
        //echo "Conexão bem-sucedida!";
    //}


?>
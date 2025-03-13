<?php
session_start();
require_once('config.php');

if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Tentar login como usuário
    $sql_usuario = "SELECT * FROM usuario WHERE email = :email AND senha = :senha";
    $stmt_usuario = $pdo->prepare($sql_usuario);
    $stmt_usuario->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt_usuario->bindParam(':senha', $senha, PDO::PARAM_STR);
    $stmt_usuario->execute();
    $result_usuario = $stmt_usuario->fetch(PDO::FETCH_ASSOC);

    if ($result_usuario) {
        $_SESSION['usuario'] = [
            'id' => $result_usuario['id'],
            'email' => $result_usuario['email'],
            'nome' => $result_usuario['nome'],
            'imagem' => $result_usuario['imagem'] ?? null,
            'descricao' => $result_usuario['descricao'] ?? null
        ];

        header('Location: user_logado.php');
        exit();
    }

    // Se não for usuário, tenta login como ONG
    $sql_ong = "SELECT * FROM ongs WHERE email = :email AND senha = :senha";
    $stmt_ong = $pdo->prepare($sql_ong);
    $stmt_ong->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt_ong->bindParam(':senha', $senha, PDO::PARAM_STR);
    $stmt_ong->execute();
    $result_ong = $stmt_ong->fetch(PDO::FETCH_ASSOC);

    if ($result_ong) {
        $_SESSION['ong'] = [
            'id' => $result_ong['id'],
            'email' => $result_ong['email'],
            'nome' => $result_ong['nome'],
            'foto_perfil' => $result_ong['foto_perfil'] ?? 'default-ong.png',
            'descricao' => $result_ong['descricao'] ?? null
        ];

        header('Location: user_logado.php');
        exit();
    }

    // Caso login falhe
    $_SESSION['login_erro'] = "E-mail ou senha incorretos!";
    header('Location: login.php');
    exit();
}
?>

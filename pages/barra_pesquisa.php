<?php
session_start();
require_once('config.php');

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

$pesquisa = $_GET['busca'] ?? '';

if (!empty($pesquisa)) {
    $sql = "SELECT id FROM ongs WHERE nome LIKE :pesquisa LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':pesquisa', "%$pesquisa%", PDO::PARAM_STR);
    $stmt->execute();
    
    $ong = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($ong) {
        // Se a ONG existe, redireciona para a página dela
        header("Location: ong.php?id=" . $ong['id']);
        exit();
    } else {
        // Se não encontrar, volta para a página anterior com uma mensagem
        header("Location: user_logado.php?erro=1");
        exit();
    }
}
?>
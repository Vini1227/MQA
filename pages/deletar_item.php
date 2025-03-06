<?php
session_start();
require_once('config.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['email'])) {
    echo "<script>alert('Você precisa estar logado para excluir um item!');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

$email = $_SESSION['email']; // Recupera o email da sessão

// Busca o ID do usuário com base no email
$sqlUsuario = "SELECT id FROM usuario WHERE email = :email";
$stmtUsuario = $pdo->prepare($sqlUsuario);
$stmtUsuario->bindParam(':email', $email, PDO::PARAM_STR);
$stmtUsuario->execute();
$usuario = $stmtUsuario->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "<script>alert('Usuário não encontrado!');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

$usuario_id = $usuario['id']; // ID do usuário logado

// Verifica se o ID do item foi passado na URL
if (isset($_GET['id'])) {
    $item_id = intval($_GET['id']); // Converte o ID para inteiro

    // Exclui o item pertencente ao usuário logado
    $sqlDelete = "DELETE FROM itens WHERE id = :item_id AND usuario_id = :usuario_id";
    $stmtDelete = $pdo->prepare($sqlDelete);
    $stmtDelete->bindParam(':item_id', $item_id, PDO::PARAM_INT);
    $stmtDelete->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);

    if ($stmtDelete->execute()) {
        echo "<script>alert('Item excluído com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao excluir o item.');</script>";
    }
}

echo "<script>window.location.href='sistema.php';</script>";

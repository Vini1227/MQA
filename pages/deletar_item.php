<?php
session_start();
require_once('config.php');

// Verifica se a ONG está logada pela sessão
if (!isset($_SESSION['ong'])) {
    echo "<script>alert('Você precisa estar logado para excluir um item!');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

$email = $_SESSION['ong']['email']; // Recupera o email da ONG logada

// Busca o ID da ONG com base no email
$sqlOng = "SELECT id FROM ongs WHERE email = :email";
$stmtOng = $pdo->prepare($sqlOng);
$stmtOng->bindParam(':email', $email, PDO::PARAM_STR);
$stmtOng->execute();
$ong = $stmtOng->fetch(PDO::FETCH_ASSOC);

if (!$ong) {
    echo "<script>alert('ONG não encontrada!');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

$ong_id = $ong['id']; // ID da ONG logada

// Verifica se o ID do item foi passado na URL
if (isset($_GET['id'])) {
    $item_id = intval($_GET['id']); // Converte o ID para inteiro

    // Exclui o item pertencente à ONG logada
    $sqlDelete = "DELETE FROM itens WHERE id = :item_id AND ong_id = :ong_id";
    $stmtDelete = $pdo->prepare($sqlDelete);
    $stmtDelete->bindParam(':item_id', $item_id, PDO::PARAM_INT);
    $stmtDelete->bindParam(':ong_id', $ong_id, PDO::PARAM_INT);

    if ($stmtDelete->execute()) {
        echo "<script>alert('Item excluído com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao excluir o item.');</script>";
    }
}

echo "<script>window.location.href='cadastromonetarioproduto.php';</script>";
?>

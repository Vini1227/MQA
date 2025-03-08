<?php
require_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $descricao = $_POST['descricao'];

    $sql = "UPDATE itens SET nome = :nome, tipo = :tipo, descricao = :descricao WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
    $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "<script>alert('Item atualizado com sucesso!');</script>";
        echo "<script>window.location.href='cadastromonetarioproduto.php';</script>";
    } else {
        echo "<script>alert('Erro ao Atualizar!');</script>";
        echo "<script>window.location.href='cadastromonetarioproduto.php';</script>";
    }
}
?>

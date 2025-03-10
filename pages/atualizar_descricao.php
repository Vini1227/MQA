<?php
session_start();
require_once('config.php');

// Verifica se a ONG está logada
if (!isset($_SESSION['ong'])) {
    echo "Você precisa estar logado para realizar essa ação.";
    exit();
}

// Recupera o ID da ONG da sessão
$ong_id = $_SESSION['ong']['id']; 

// Verifica se a descrição foi enviada via POST
if (isset($_POST['descricao'])) {
    $descricao = $_POST['descricao'];

    try {
        // Atualiza a descrição no banco de dados
        $sqlUpdate = "UPDATE ongs SET descricao = :descricao WHERE id = :ong_id";
        $stmtUpdate = $pdo->prepare($sqlUpdate);
        $stmtUpdate->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':ong_id', $ong_id, PDO::PARAM_INT);
        $stmtUpdate->execute();

        // Exibe uma mensagem de sucesso diretamente na página
        echo "<script>alert('Descrição atualizada com sucesso!');</script>";
        echo "<script>window.location.href = 'cadastromonetarioproduto.php';</script>";


    } catch (PDOException $e) {
        // Em caso de erro, exibe uma mensagem de erro
        echo "<script>alert('Erro ao atualizar a descrição!');</script>";
        echo "<script>window.location.href = 'cadastromonetarioproduto.php';</script>";

    }
} else {
    // Caso o formulário não tenha sido enviado corretamente
    echo "<script>alert('Descrição não foi enviada.');</script>";
    echo "<script>window.location.href = 'cadastromonetarioproduto.php';</script>";

}
?>

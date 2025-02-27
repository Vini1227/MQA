<?php
require_once('config.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id']; 
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $descricao = $_POST['descricao'];


    if (isset($id)) {
        $sqlUpdate = "UPDATE usuario  SET nome = :nome, senha = :senha, descricao = :descricao WHERE id = :id"; 
        
        $stmt = $pdo->prepare($sqlUpdate);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);

        if ($stmt->execute()) {
           echo "<script>alert('Registro atualizado com sucesso!');</script>";
           echo "<script>window.location.href='sistema.php';</script>";
        }
    } else {
        echo "<script>alert('Erro ao Atualizar');</script>";
        echo "<script>window.location.href='sistema.php';</script>";
    }
}
?>
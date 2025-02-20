<?php
require_once('config.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id']; 
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confir_senha = $_POST['confir_senha'];
    $descricao = $_POST['descricao'];


    if ($senha == $confir_senha) {
        $sqlUpdate = "UPDATE cadastro SET usuario = :usuario, email = :email, senha = :senha, descricao = :descricao, confir_senha = :confir_senha WHERE id = :id"; 
        
        $stmt = $pdo->prepare($sqlUpdate);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindParam(':confir_senha', $confir_senha, PDO::PARAM_STR);   

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
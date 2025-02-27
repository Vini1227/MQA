<?php
require_once('config.php');


if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $sqlDelete = "DELETE FROM usuario WHERE id = '$id'";
    $stmt = $pdo->prepare($sqlDelete);

    if ($stmt->execute() === TRUE) {

        echo "<script>alert('Registro excluído com sucesso!');</script>";
    } else {

        //echo "<script>alert('Erro ao excluir o registro: {$conexao->error}');</script>";
    }

    echo "<script>window.location.href='sistema.php';</script>";
} else {

    echo "<script>alert('ID inválido!');</script>";
    echo "<script>window.location.href='sistema.php';</script>";
}
?>
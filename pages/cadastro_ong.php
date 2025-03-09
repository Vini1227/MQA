<?php

include('config.php');

$nome = $_POST['nome'];
$senha = $_POST['senha'];
$email = $_POST['email'];
$cnpj = $_POST['cnpj'];


try {

    $stmt = $pdo->prepare("INSERT INTO ongs (nome, email, senha, cnpj) VALUES (:nome, :email, :senha, :cnpj)");

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':cnpj', $cnpj);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Erro ao inserir os dados']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Erro ao conectar ou inserir dados: ' . $e->getMessage()]);
}
?>
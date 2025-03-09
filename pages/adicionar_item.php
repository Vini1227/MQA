<?php
session_start();
require_once('config.php');

// Verifica se a ONG está logada pela sessão
if (!isset($_SESSION['ong'])) {
    echo "<script>alert('Você precisa estar logado para cadastrar um item!');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

$email = $_SESSION['ong']['email']; // Recupera o email da ONG logada

// Busca o ID da ONG com base no email
$sqlOng = "SELECT id FROM ongs WHERE email = :email";
$stmt = $pdo->prepare($sqlOng);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->execute();
$ong = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$ong) {
    echo "<script>alert('ONG não encontrada!');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

$ong_id = $ong['id']; // Define o ID da ONG logada

// Processa o formulário ao enviar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? null;
    $tipo = $_POST['tipo'] ?? null;
    $descricao = $_POST['descricao'] ?? null;

    // Validação de campos obrigatórios
    if (empty($nome) || empty($tipo)) {
        echo "<script>alert('Os campos Nome e Tipo são obrigatórios!');</script>";
        echo "<script>window.location.href='cadastromonetarioproduto.php';</script>";
        exit();
    }

    // Escapar os dados de entrada para evitar SQL Injection (embora já esteja usando Prepared Statements)
    $nome = htmlspecialchars($nome);
    $tipo = htmlspecialchars($tipo);
    $descricao = htmlspecialchars($descricao);

    try {
        // Insere o item no banco de dados, associando o ID da ONG
        $sql = "INSERT INTO itens (nome, tipo, descricao, ong_id) VALUES (:nome, :tipo, :descricao, :ong_id)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindParam(':ong_id', $ong_id, PDO::PARAM_INT);
        $stmt->execute();

        // Feedback para o usuário
        echo "<script>alert('Item cadastrado com sucesso!');</script>";
        echo "<script>window.location.href='cadastromonetarioproduto.php';</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Erro ao cadastrar item: " . $e->getMessage() . "');</script>";
        echo "<script>window.location.href='cadastromonetarioproduto.php';</script>";
    }
}
?>

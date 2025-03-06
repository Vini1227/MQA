<?php
session_start();
require_once('config.php');

// Verifica se o usuário está logado pelo email
if (!isset($_SESSION['email'])) {
    echo "<script>alert('Você precisa estar logado para cadastrar um item!');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

$email = $_SESSION['email']; // Recupera o email da sessão

// Busca o ID do usuário com base no email
$sqlUsuario = "SELECT id FROM usuario WHERE email = :email";
$stmt = $pdo->prepare($sqlUsuario);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "<script>alert('Usuário não encontrado!');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

$usuario_id = $usuario['id']; // Define o ID do usuário logado

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

    try {
        // Insere o item no banco de dados
        $sql = "INSERT INTO itens (nome, tipo, descricao, usuario_id) VALUES (:nome, :tipo, :descricao, :usuario_id)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->execute();

        echo "<script>alert('Item cadastrado com sucesso!');</script>";
        echo "<script>window.location.href='cadastromonetarioproduto.php';</script>";
    } catch (PDOException $e) {
        echo "Erro ao cadastrar item: " . $e->getMessage();
    }
}
?>


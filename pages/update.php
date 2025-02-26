<?php
require 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Busca o usuário pelo ID
    $sql = "SELECT * FROM cadastro WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifica se o usuário foi encontrado
if (!$usuario) {
        echo "<script>alert('Usuário não encontrado!');</script>";
        echo "<script>window.location.href='sistema.php';</script>";
        exit;
}
// Exibe o formulário de edição
} else {
    echo "<script>alert('ID inválido!');</script>";
    echo "<script>window.location.href='sistema.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
</head>
<body>
    <h1>Editar Usuário</h1>
    <form method="POST" action="./config_update.php">
        
        <label>Usuário:</label>
        <input type="text" name="usuario" value="<?= $usuario['usuario'] ?>" required><br><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?= $usuario['email'] ?>" required><br><br>
        
        <label>Senha:</label>
        <input type="password" name="senha" value="<?= $usuario['senha'] ?>" required><br><br>
        
        <label>Confirmar Senha:</label>
        <input type="password" name="confir_senha" value="<?= $usuario['confir_senha'] ?>" required><br><br>    
        
        <label>Descrição:</label>
        <input type="text" name="descricao" value="<?= $usuario['descricao'] ?>" required><br><br>
        
        <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
        
        <button type="submit">Atualizar</button>
    </form>
</body>
</html>

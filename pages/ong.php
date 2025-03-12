<?php
require_once('config.php');

$id = $_GET['id'] ?? '';

if (!empty($id)) {
    $sql = "SELECT * FROM ongs WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $ong = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$ong) {
        echo "<h1>ONG não encontrada!</h1>";
        exit();
    }
} else {
    echo "<h1>ID da ONG não especificado!</h1>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $ong['nome']; ?></title>
</head>
<body>
    <h1><?php echo $ong['nome']; ?></h1>
    <p>Email: <?php echo $ong['email']; ?></p>
    <p>Descrição: <?php echo $ong['descricao'] ?: 'Sem descrição disponível'; ?></p>
    <a href="user_logado.php">Voltar</a>
</body>
</html>
<?php
session_start();
require_once('config.php');


if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: user_logado.php'); 
    exit();
}

$id = $_GET['id'];

$sql = "SELECT nome, descricao FROM ongs WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$ong = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$ong) {
    echo "ONG não encontrada.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($ong['nome']); ?></title>
    <link rel="stylesheet" href="../css/ong.css">
</head>
<body>

    <header>
        <h1><?php echo htmlspecialchars($ong['nome']); ?></h1>
    </header>

    <div class="ong-container">
        <p><?php echo htmlspecialchars($ong['descricao']); ?></p>
    </div>

</body>
</html>

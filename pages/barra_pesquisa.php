<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

require_once('config.php');


$pesquisa =  $_GET['busca'] ?? '';

$mensagem = '';
$ongs = [];


if (!empty($pesquisa)) {
    $sql = "SELECT * FROM ongs WHERE nome LIKE :pesquisa";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':pesquisa', "%$pesquisa%", PDO::PARAM_STR);
    $stmt->execute();

    $ongs = $stmt->fetchAll(PDO::FETCH_ASSOC); 

    if (empty($ongs)) { 
        $mensagem = 'Nenhuma ONG encontrada';
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado da Pesquisa</title>
</head>
<body>
    <h1>Resultado da Pesquisa</h1>

    <?php if (!empty($mensagem)): ?>
        <p><?php echo $mensagem; ?></p>
    <?php else: ?>
        <?php foreach ($ongs as $ong): ?>
            <div>
                <h2><?php echo htmlspecialchars($ong['nome']); ?></h2>
                <p><?php echo htmlspecialchars($ong['descricao'] ?? 'Descrição não disponível'); ?></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</body>
</html>



<?php
session_start();
require_once('config.php');

if (!isset($_SESSION['usuario'])) {
    header('Location: ./login.php');
    exit();
}

$usuario = $_SESSION['usuario'];

// Verifica se o ID da ONG foi passado pela URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID da ONG não especificado.";
    exit();
}

$id = intval($_GET['id']); // Evita SQL Injection

// Busca a ONG no banco de dados
$stmt = $pdo->prepare("SELECT * FROM ongs WHERE id = ?");
$stmt->execute([$id]);
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
    <title><?php echo htmlspecialchars($ong['nome'], ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="stylesheet" href="../css/perfil_ong.css">
</head>
<body>
    <div class="app">
        <div class="header">
            <div class="nav">
                <img class="mqa" src="../imgs/MQA_whitewithtext.svg" alt="">
            </div>
            <div class="link">
                <a href="./user_perfil.php" id="b3">
                    <img src="<?php echo isset($usuario['imagem']) && !empty($usuario['imagem']) ? '../uploads/users/' . $usuario['imagem'] : '../imgs/doador.png'; ?>" class="user-img" alt="Foto do usuário">
                    <?php echo $usuario['nome']; ?>
                </a>
                <a href="./logout.php" id="b4">Sair</a>
            </div>
        </div>  
        <div class="banner-perf-box">
        <img class="banner-do-perfil" 
     src="<?php echo isset($ong['banner']) && !empty($ong['banner']) ? htmlspecialchars($ong['banner'], ENT_QUOTES, 'UTF-8') : '../imgs/banner.png'; ?>" 
     alt="Banner da ONG">

            <div>
                <p id="nome-texto" class="texto-banner"><?php echo htmlspecialchars($ong['nome'], ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
        </div>
        <div class="img-perf-box">
        <img class="imagem-do-perfil" 
     src="<?php echo !empty($ong['foto_perfil']) ? htmlspecialchars($ong['foto_perfil'], ENT_QUOTES, 'UTF-8') : '../imgs/doador.png'; ?>" 
     alt="Logo da ONG">
        </div>
        <div>
        <p class="fonte">
    <?php echo isset($ong['descricao']) && !empty($ong['descricao']) ? htmlspecialchars($ong['descricao'], ENT_QUOTES, 'UTF-8') : 'Esta ONG ainda não adicionou uma descrição.'; ?>
</p>
        </div>
    </div>
</body>
</html>

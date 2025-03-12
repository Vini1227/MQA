<?php
session_start();
require_once('config.php');
require_once('./cards.php');

if(!isset($_SESSION['usuario'])) {
    header('Location:./login.php');
    exit();
}

$usuario = $_SESSION['usuario'];
$imagemPerfil = isset ($usuario['imagem']) && !empty($usuario['imagem']) ? $usuario['imagem'] : '../imgs/doador.png';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User_logado</title>
    <link rel="shortcut icon" href="../imgs/MQA_blue.svg" type="image/x-icon">
    <link rel="stylesheet" href="../css/user_logado.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Krona+One&family=Lalezar&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <header>
        <img class="v3" src="../imgs/MQA_whitewithtext.svg" alt="">

        <div class="link">
            <a href="./user_perfil.php" id="b3">
            <img src="<?php echo isset($usuario['imagem']) && !empty($usuario['imagem']) ? '../uploads/users/' . $usuario['imagem'] : '../imgs/doador.png'; ?>" class="user-img" alt="Foto do usuário">
            <?php echo $usuario['nome']; ?>
        </a>
            <a href="./logout.php" id="b4">Sair</a>
        </div>
            
    </header>
    <form action="./barra_pesquisa.php" method="get">
    <div class="content-pesq">
        <input name="busca" type="search" class="pesq" placeholder="Procure por uma ONG">
        <button type="submit" class="icone">
            <i class="fas fa-search"></i>
        </button>
    </div>
</form>
<?php if (isset($_GET['erro']) && $_GET['erro'] == 1): ?>
    <p class="erro-msg">Nenhuma ONG encontrada.</p>
<?php endif; ?>

    <div class="title">
        <h1>Descubra ONGS</h1>
    </div>
    <div class="content-ongs">
    <?php if (!empty($ongs)): ?>
        <?php foreach ($ongs as $ong): ?>
            <div class="card_ong">
                <a href="perfil_ong.php?id=<?php echo $ong['id']; ?>" class="card-link">
                    <img src="<?php echo htmlspecialchars($ong['banner'], ENT_QUOTES, 'UTF-8'); ?>" alt="Banner da ONG" class="card-img">
                    <button class="botao-ong"><?php echo htmlspecialchars($ong['nome'], ENT_QUOTES, 'UTF-8'); ?></button>
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="erro-msg">Nenhuma ONG encontrada.</p>
    <?php endif; ?>
</div>

</body>
</html>
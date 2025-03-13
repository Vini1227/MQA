<?php
session_start();
require_once('config.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario']) && !isset($_SESSION['ong'])) {
    header('Location: ./login.php');
    exit();
}

// Captura a sessão do usuário
$usuario = $_SESSION['usuario'] ?? null;

// Verifica se o ID da ONG foi passado
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

// Captura o ID do usuário
$user_id = $_GET['user_id'] ?? ($usuario ? $usuario['id'] : null);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/itensUsuario.css">
    <title>Doação para <?php echo htmlspecialchars($ong['nome'], ENT_QUOTES, 'UTF-8'); ?></title>
</head>
<body>
    <div class="app">
        <div class="header">
            <div class="nav">
                <img class="mqa" src="../imgs/MQA_whitewithtext.svg" alt="">
            </div>
        </div>

        <div class="ong-profile">
            <div class="ong-profile-space">
                <div class="ong-profile-img">
                    <img class="ong-profile-img-logo" src="<?php echo !empty($ong['foto_perfil']) ? htmlspecialchars($ong['foto_perfil'], ENT_QUOTES, 'UTF-8') : '../imgs/avatar.png'; ?>" alt="Logo da ONG">
                </div>
                <div class="ong-profile-info">
                    <h1 class="ong-profile-title"><?php echo htmlspecialchars($ong['nome'], ENT_QUOTES, 'UTF-8'); ?></h1>
                </div>
            </div>
        </div>

        <div class="main">
            <div id="donatetype-card" class="donatetype-card">
                <div class="dnttp-title">
                    <h1 class="dnttp-card-title">O que você deseja doar para: ONG <?php echo htmlspecialchars($ong['nome'], ENT_QUOTES, 'UTF-8'); ?></h1>
                </div>
                <div class="dnttp-buttons">
                    <button class="dnttp-money">Dinheiro</button>
                    <button id="card-toggle-1" class="dnttp-itens">Itens</button>
                </div>
            </div>

            <form action="processar_doacao.php" method="POST" onsubmit="return validateForm()">
                <input type="hidden" name="ong_id" value="<?php echo $id; ?>">
                <input type="hidden" name="usuario_id" value="<?php echo $user_id; ?>">

                <div id="iten-donate-card" class="iten-donate-card">
                    <div class="itndnt-inputs">
                        <div class="input-dropdown">
                            <button class="dropdown-button" type="button">
                                <p class="bold-text" id="dropdown-selected">Lista de Itens</p>
                                <i class="fa-solid fa-angle-down"></i>
                            </button>
                            <div class="dropdown-content">
                                <a href="#" data-value="Alimentos">Alimentos</a>
                                <a href="#" data-value="Roupas">Roupas</a>
                                <a href="#" data-value="Higiene">Higiene</a>
                            </div>
                        </div>
                        <input type="hidden" name="item" id="selected-item">

                        <div class="input-count">
                            <div class="input-count-text">
                                <p class="bold-text">Quantidade</p>
                            </div>
                            <div class="input-count-number"> 
                                <button type="button" class="count-decrement"><i class="fa-solid fa-minus"></i></button>
                                <input type="number" id="number-input" name="quantidade" value="0" min="0" max="100" maxlength="3">
                                <button type="button" class="count-increment"><i class="fa-solid fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="prev-step">
                            <button id="card-toggle-2" class="prev-step-button" type="button"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                    </div>

                    <div class="itndnt-description"> 
                        <label for="descricao">Descrição</label>
                        <textarea maxlength="213" class="input-desc" type="text" name="descricao" id="descricao"></textarea>
                    </div>

                    <div class="itndnt-button">
                        <button class="dnt-button" type="submit">Doar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="../js/itensUsuario.js"></script>
</body>
</html>

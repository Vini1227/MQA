<?php
session_start();
require_once('config.php');

// Verifica se os dados da ONG estão armazenados na sessão
if (!isset($_SESSION['ong_dados'])) {
    echo "Dados da ONG não encontrados.";
    exit();
}

$ong = $_SESSION['ong_dados'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/b0c267dc7d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/itensUsuario.css">
    <link rel="shortcut icon" href="../imgs/MQA_blue.svg" type="image/x-icon">
    <title><?php echo htmlspecialchars($ong['nome'], ENT_QUOTES, 'UTF-8'); ?></title>
</head>
<body>
    <div class="app"> <!-- classe app é a div pai de toda pagina -->
        <div class="header">
            <div class="nav">
                <img class="mqa" src="../imgs/MQA_whitewithtext.svg" alt="">
                <div class="nav-links"> <!-- links do header -->
                </div>
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
        <div class="main"> <!-- parte principal da pagina -->
            <div id="donatetype-card" class="donatetype-card">
                <div class="dnttp-title">
                    <h1 class="dnttp-card-title">O que você deseja doar para: ONG <?php echo htmlspecialchars($ong['nome'], ENT_QUOTES, 'UTF-8'); ?></h1>
                </div>
                <div class="dnttp-buttons">
                    <button class="dnttp-money">Dinheiro</button>
                    <button id="card-toggle-1" class="dnttp-itens">Itens</button>
                </div>
            </div>
            <form action="visao_ong.php" method="POST" onsubmit="return validateForm()">
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
                        <!-- Campo oculto para armazenar o valor selecionado -->
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


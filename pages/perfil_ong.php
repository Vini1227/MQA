<?php
session_start();
require_once('config.php');

// Permitir que tanto usuários quanto ONGs acessem a página
if (!isset($_SESSION['usuario']) && !isset($_SESSION['ong'])) {
    header('Location: ./login.php');
    exit();
}

// Identifica quem está logado
$usuario = $_SESSION['usuario'] ?? null;
$ongLogada = $_SESSION['ong'] ?? null;

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

// Busca os itens que a ONG aceita receber
$stmt_itens = $pdo->prepare("SELECT * FROM itens WHERE ong_id = ?");
$stmt_itens->execute([$id]);
$itens = $stmt_itens->fetchAll(PDO::FETCH_ASSOC);

// Armazena os dados da ONG na sessão
$_SESSION['ong_dados'] = $ong;

// Redireciona para a nova página
header("Location: ../pages/cadastro-itens-usuario.php");
exit();
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
                <img class="mqa" src="../imgs/MQA_whitewithtext.svg" alt="Logo MQA">
            </div>
            <div class="link">
                <?php if ($usuario): ?>
                    <!-- Se um usuário estiver logado -->
                    <a href="./user_perfil.php" id="b3">
                        <img src="<?php echo isset($usuario['imagem']) && !empty($usuario['imagem']) ? '../uploads/users/' . $usuario['imagem'] : '../imgs/doador.png'; ?>" 
                             class="user-img" alt="Foto do usuário">
                        <?php echo $usuario['nome']; ?>
                    </a>
                <?php elseif ($ongLogada): ?>
                    <!-- Se uma ONG estiver logada -->
                    <a href="./cadastromonetarioproduto.php" id="b3">
                        <img src="<?php echo isset($ongLogada['imagem']) && !empty($ongLogada['imagem']) ? '../uploads/ongs/' . $ongLogada['imagem'] : '../imgs/doador.png'; ?>" 
                             class="user-img" alt="Foto da ONG">
                        <?php echo $ongLogada['nome']; ?>
                    </a>
                <?php endif; ?>
                <a href="./logout.php" id="b4">Sair</a>
            </div>
        </div>  

        <div class="banner-perf-box">
            <img class="banner-do-perfil" src="<?php echo !empty($ong['banner']) ? htmlspecialchars($ong['banner'], ENT_QUOTES, 'UTF-8') : '../imgs/banner.png'; ?>" 
                 alt="Banner da ONG">
            <div>
                <p id="nome-texto" class="texto-banner">
                    <?php echo htmlspecialchars($ong['nome'], ENT_QUOTES, 'UTF-8'); ?>
                </p>
            </div>
        </div>

        <div class="img-perf-box">
            <img class="imagem-do-perfil" 
                 src="<?php echo !empty($ong['foto_perfil']) ? htmlspecialchars($ong['foto_perfil'], ENT_QUOTES, 'UTF-8') : '../imgs/doador.png'; ?>" 
                 alt="Logo da ONG">
        </div>

        <div>
            <p class="fonte">
                <?php echo !empty($ong['descricao']) ? htmlspecialchars($ong['descricao'], ENT_QUOTES, 'UTF-8') : 'Esta ONG ainda não adicionou uma descrição.'; ?>
            </p>
        </div>

        <div class="recebidos-box">
            <p class="titulos">Recebemos:</p>
            <div class="alinhador">
                <div class="itens-box">
                    <table>
                        <tr>
                            <th>Nome</th>
                            <th>Tipo</th>
                            <th>Descrição</th>
                        </tr>
                        <?php if (!empty($itens)): ?>
                            <?php foreach ($itens as $item): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($item['nome'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($item['tipo'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo !empty($item['descricao']) ? htmlspecialchars($item['descricao'], ENT_QUOTES, 'UTF-8') : 'Sem descrição'; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">Nenhum item registrado.</td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
                <button class="botaodoar-box">
                    <a href="../pages/cadastro-itens-usuario.php" class="texto-doar">DOAR AGORA!!!</a>
                </button>
            </div>
        </div>
    </div>
</body>
</html>

<?php
require_once('config.php');

$ongs = [];
$error = false;

if (isset($_GET['busca']) && !empty($_GET['busca'])) {
    $busca = $_GET['busca'];
    $sql = "SELECT nome, banner FROM ongs WHERE nome LIKE :busca";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':busca', "%$busca%", PDO::PARAM_STR);
    $stmt->execute();
    $ongsPesquisadas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($ongsPesquisadas)) {
        $error = true;

        if (isset($_SESSION['ongs_exibidas'])) {
            $ongs = $_SESSION['ongs_exibidas'];
        } else {
            $sql = "SELECT nome, banner FROM ongs ORDER BY RAND() LIMIT 5";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $ongs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['ongs_exibidas'] = $ongs; 
        }
    } else {
        $ongs = $ongsPesquisadas;
    }
} else {
    $sql = "SELECT id, nome, banner FROM ongs ORDER BY RAND() LIMIT 5";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $ongs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['ongs_exibidas'] = $ongs; 
}
?>

<script src="/js/mensagem_erro.js"></script>

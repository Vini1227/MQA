<?php
require_once('config.php');

$ongs = [''];

if (!isset($_SESSION['usuario'])) {
    header('Location: ./login.php');
    exit();
}

$usuario = $_SESSION['usuario'];

// Consulta apenas o banner e o nome das ONGs
$sql = "SELECT nome, banner FROM ongs";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$ongs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

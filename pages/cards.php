<?php
require_once('config.php');

// Consulta apenas o banner e o nome das ONGs
$sql = "SELECT nome, banner FROM ongs";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$ongs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Embaralha as ONGs
shuffle($ongs);

// Pega no máximo 5 ONGs
$ongs = array_slice($ongs, 0, 5);
?>
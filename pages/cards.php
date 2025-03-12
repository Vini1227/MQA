<?php
require_once('config.php');

// Consulta o ID, nome e banner das ONGs
$sql = "SELECT id, nome, banner FROM ongs"; // Adicione o ID na consulta
$stmt = $pdo->prepare($sql);
$stmt->execute();
$ongs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Embaralha as ONGs
shuffle($ongs);

// Pega no máximo 5 ONGs
$ongs = array_slice($ongs, 0, 5);
?>

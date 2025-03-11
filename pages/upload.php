<?php
session_start();
require_once('config.php');

// Verifica se a ONG está logada
if (!isset($_SESSION['ong'])) {
    echo "<script>alert('Você precisa estar logado!');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

$ong_id = $_SESSION['ong']['id'];

// Diretório para salvar as imagens
$uploadDir = "uploads/ongs/";

// Cria o diretório se não existir
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$perfilPath = null;
$bannerPath = null;
$novoNome = isset($_POST['nome']) ? $_POST['nome'] : '';  // Recupera o novo nome

// Verifica se o nome foi enviado e se está não vazio
if (empty($novoNome)) {
    // Se o nome não foi enviado ou está vazio, mantém o nome original
    echo "<script>alert('Nome da ONG não foi alterado.');</script>";
}

// Upload da foto de perfil
if (!empty($_FILES['perfil']['name'])) {
    $perfilPath = $uploadDir . "perfil_" . $ong_id . ".jpg";
    move_uploaded_file($_FILES['perfil']['tmp_name'], $perfilPath);
}

// Upload do banner
if (!empty($_FILES['banner']['name'])) {
    $bannerPath = $uploadDir . "banner_" . $ong_id . ".jpg";
    move_uploaded_file($_FILES['banner']['tmp_name'], $bannerPath);
}

// Atualiza o banco de dados apenas com os campos preenchidos
$sqlUpdate = "UPDATE ongs SET nome = :nome, ";
$params = [':nome' => $novoNome];

if ($perfilPath) {
    $sqlUpdate .= "foto_perfil = :foto_perfil, ";
    $params[':foto_perfil'] = $perfilPath;
}

if ($bannerPath) {
    $sqlUpdate .= "banner = :banner, ";
    $params[':banner'] = $bannerPath;
}

$sqlUpdate = rtrim($sqlUpdate, ", ") . " WHERE id = :id";
$params[':id'] = $ong_id;

$stmt = $pdo->prepare($sqlUpdate);
$stmt->execute($params);

echo "<script>alert('Imagens e Nome atualizados com sucesso!');</script>";
echo "<script>window.location.href='cadastromonetarioproduto.php';</script>";
?>

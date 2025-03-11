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

// Verifica e faz o upload da foto de perfil
if (!empty($_FILES['perfil']['name'])) {
    // Verifica se o arquivo é uma imagem válida
    if (getimagesize($_FILES['perfil']['tmp_name'])) {
        $perfilPath = $uploadDir . "perfil_" . $ong_id . ".jpg";
        if (move_uploaded_file($_FILES['perfil']['tmp_name'], $perfilPath)) {
            echo "<script>alert('Foto de perfil carregada com sucesso!');</script>";
        } else {
            echo "<script>alert('Erro ao fazer upload da foto de perfil.');</script>";
        }
    } else {
        echo "<script>alert('O arquivo de perfil não é uma imagem válida.');</script>";
    }
}

// Verifica e faz o upload do banner
if (!empty($_FILES['banner']['name'])) {
    // Verifica se o arquivo é uma imagem válida
    if (getimagesize($_FILES['banner']['tmp_name'])) {
        $bannerPath = $uploadDir . "banner_" . $ong_id . ".jpg";
        if (move_uploaded_file($_FILES['banner']['tmp_name'], $bannerPath)) {
            echo "<script>alert('Banner carregado com sucesso!');</script>";
        } else {
            echo "<script>alert('Erro ao fazer upload do banner.');</script>";
        }
    } else {
        echo "<script>alert('O arquivo do banner não é uma imagem válida.');</script>";
    }
}

// Verifica se pelo menos uma imagem foi carregada antes de tentar atualizar no banco de dados
if ($perfilPath || $bannerPath) {
    // Atualiza o banco de dados apenas com os campos preenchidos
    $sqlUpdate = "UPDATE ongs SET ";
    $params = [];

    // Se a foto de perfil foi carregada, adiciona no banco
    if ($perfilPath) {
        $sqlUpdate .= "foto_perfil = :foto_perfil, ";
        $params[':foto_perfil'] = $perfilPath;
    }

    // Se o banner foi carregado, adiciona no banco
    if ($bannerPath) {
        $sqlUpdate .= "banner = :banner, ";
        $params[':banner'] = $bannerPath;
    }

    // Remover a vírgula extra caso nenhum arquivo tenha sido atualizado
    $sqlUpdate = rtrim($sqlUpdate, ", ") . " WHERE id = :id";
    $params[':id'] = $ong_id;

    // Depuração: Exibe a query para verificar se está correta
    echo "<pre>";
    echo "SQL: " . $sqlUpdate . "\n";
    echo "Parâmetros: ";
    print_r($params);
    echo "</pre>";

    // Prepara e executa a query
    try {
        $stmt = $pdo->prepare($sqlUpdate);
        $stmt->execute($params);

        echo "<script>alert('Imagens atualizadas com sucesso!');</script>";
        echo "<script>window.location.href='cadastromonetarioproduto.php';</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Erro ao atualizar as imagens: " . $e->getMessage() . "');</script>";
    }
} else {
    echo "<script>alert('Nenhuma imagem foi carregada.');</script>";
}
?>

<?php
session_start();
require_once('config.php');

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

$usuario = $_SESSION['usuario'];

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['imagem'])) {
    $imagem = $_FILES['imagem'];
    $imagemErro = $imagem['error']; 

    if ($imagemErro == 0) {
        $imagemNome = $imagem['name'];
        $imagemTmp = $imagem['tmp_name'];
    
        $imagemNovoNome = uniqid('' , true) . '.' . pathinfo($imagemNome, PATHINFO_EXTENSION);
        $imagemDestino = "../uploads/users/" . $imagemNovoNome;

        if (!is_dir("../uploads/users/")) {
            mkdir("../uploads/users/", 0755, true);
        }

        if (move_uploaded_file($imagemTmp, $imagemDestino)) {
            $sql = "UPDATE usuario SET imagem = :imagem WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':imagem', $imagemNovoNome, PDO::PARAM_STR);
            $stmt->bindParam(':id', $usuario['id'], PDO::PARAM_INT);
            $stmt->execute();

            $_SESSION['usuario']['imagem'] = $imagemNovoNome;

            echo "<script>alert('Imagem alterada com sucesso!');</script>";
            echo "<script>window.location.href='user_logado.php';</script>";
        } else {
            echo "<script>alert('Erro ao alterar a imagem.');</script>";
            echo "<script>window.location.href='user_perfil.php';</script>";
        }
    } else {
        echo "<script>alert('Erro ao enviar a imagem.');</script>";
        echo "<script>window.location.href='user_perfil.php';</script>";    
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../imgs/MQA_blue.svg" type="image/x-icon">
    <title>user_perfil</title>
</head>
<body>

<h2>Alterar Imagem de Perfil</h2>

<form action="user_perfil.php" method="POST" enctype="multipart/form-data">
    <label for="imagem">Escolha uma nova imagem para o perfil:</label>
    <input type="file" name="imagem" id="imagem" accept="image/*" required>
    <button type="submit">Alterar Imagem</button>
</form>

</body>
</html>
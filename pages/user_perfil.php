<?php
session_start();
require_once('config.php');

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

$usuario = $_SESSION['usuario'];
$nome = isset($usuario['nome']) ? $usuario['nome'] : '';
$descricao = isset($usuario['descricao']) ? $usuario['descricao'] : '';
$imagemNovoNome = isset($usuario['imagem']) ? $usuario['imagem'] : 'default.png';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'] ?? $nome;
    $descricao = $_POST['descricao'] ?? $descricao;

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $imagem = $_FILES['imagem'];
        $imagemNome = $imagem['name'];
        $imagemTmp = $imagem['tmp_name'];

        $imagemNovoNome = uniqid('', true) . '.' . pathinfo($imagemNome, PATHINFO_EXTENSION);
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
        }
    } else {
        
        $imagemNovoNome = $usuario['imagem'];
    }

   
    $sql = "UPDATE usuario SET nome = :nome, descricao = :descricao WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
    $stmt->bindParam(':id', $usuario['id'], PDO::PARAM_INT);
    $stmt->execute();


    $_SESSION['usuario']['nome'] = $nome;
    $_SESSION['usuario']['descricao'] = $descricao;
    $_SESSION['usuario']['imagem'] = $imagemNovoNome;

    echo "<script>alert('Perfil atualizado com sucesso!');</script>";
    echo "<script>window.location.href='user_logado.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/user_perfil.css">
    <title>Perfil do Usuário</title>
</head>
<body>
    <header>    
        <img class="mqa" src="../imgs/MQA_whitewithtext.svg" alt="">

    </header>

<div class="container">
    <h2>Perfil</h2>

    <div class="profile-header">
        <img src="<?php echo '../uploads/users/' . htmlspecialchars($imagemNovoNome); ?>" alt="Foto de Perfil">
        <h3><?php echo htmlspecialchars($nome); ?></h3>
        <p><?php echo htmlspecialchars($descricao); ?></p>
    </div>

    <h2>Editar Perfil</h2>

    <form action="user_perfil.php" method="POST" enctype="multipart/form-data">
        <label for="imagem">Alterar Foto de Perfil:</label>
        <input type="file" name="imagem" id="imagem" accept="image/*">
        <br>
        
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($nome); ?>" required>
        <br>
        
        <label for="descricao">Descrição:</label>
        <textarea name="descricao" id="descricao" rows="4" required><?php echo htmlspecialchars($descricao); ?></textarea>
        <br>
        
        <button type="submit">Salvar Alterações</button>
    </form>
</div>

</body>
</html>
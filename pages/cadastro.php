<?php
if (isset($_POST['submit'])) {
    require_once('config.php');

    // Coletando dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $descricao = $_POST['descricao'];

   if (empty($nome) || empty($email) || empty($senha) || empty($descricao)) {
      echo "<script>alert('Preencha todos os campos!');</script>";
      echo "<script>window.location.href='cadastro.php';</script>";
      exit();
   }

    // Verificando se as senhas coincidem
    if ($senha !== $_POST['confir_senha']) {
      echo "<script>alert('Senhas não coincidem!');</script>";
      echo "<script>window.location.href='cadastro.php';</script>";
      exit();
   }

   try {
      $sql = $pdo->prepare("SELECT * FROM usuario WHERE email = :email");
      $sql->bindParam(':email', $email);
      $sql->execute();
      $existe = $sql->fetchColumn();

   if ($existe > 0) {
      echo "<script>alert('Email ja cadastrado! Seu Corno!');</script>";
      echo "<script>window.location.href='cadastro.php';</script>";
      exit();
   }


            // Preparando a consulta SQL
            $sql = "INSERT INTO usuario (nome, email, senha, descricao) VALUES (:nome, :email, :senha, :descricao)";
            $stmt = $pdo->prepare($sql);

            // Vinculando os parâmetros
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':descricao', $descricao);

            // Executando a consulta
            $stmt->execute();

            // Redirecionando para a página de login
            header('Location:login.php');
            exit();
        } catch (PDOException $e) {
            // Exibindo mensagem de erro
            echo "Falha na Conexão: " . $e->getMessage();
        }
    }
   
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/cadastro.css">
    <link rel="shortcut icon" href="../imgs/MQA_blue.svg" type="image/x-icon">
    <title>Cadastro</title>
</head>
<body>
   <div class="app">
      <div class="header">
         <div class="nav">
           <img class="mqa" src="../imgs/MQA_white.svg" alt="">
           <div class="nav-links">
           <a class="nav-link" href="../html/login.php">Login</a>
           <a class="nav-link" href="../html/cadastro.php">Sign-up</a>
           </div>
         </div>
      </div>
      <div class="main">
         <div class="login-card">
            <h1 class="card-title">Cadastrar-se</h1>
            <form action="cadastro.php" method="post">
            <div class="card-inputs">
            <div class="card-input"> 
               <label for="nome">Nome</label>
               <input class="wrap-input" type="text" name="usuario" id="usuario">
            </div>
            <div class="card-input"> 
               <label for="email">E-mail</label>
               <input class="wrap-input" type="email" name="email" id="email">
            </div>
            <div class="card-input"> 
               <label for="senha">Senha</label>
               <input class="wrap-input" type="password" name="senha" id="senha">
            </div>
            <div class="card-input"> 
               <label for="senha">Confirmar Senha</label>
               <input class="wrap-input" type="password" name="confir_senha" id="confir_senha">
            </div>
            <div class="nowrap-card-input"> 
               <label for="descricao">Descrição</label>
               <textarea maxlength="213" class="nowrap-input" type="text" name="descricao" id="descricao"></textarea>
            </div>
            </div>
            <input class="card-button" type="submit" name="submit" value="Registrar">
         </div>
      </div>
   </div>
</body>
</html>

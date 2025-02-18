<?php
if (isset($_POST['submit'])) {
    // Incluindo arquivo de configuração do banco de dados
    include_once('./html/config.php');

    // Verificando se a conexão foi estabelecida
    if ($conexao) {
        // Coletando dados do formulário
        $usuario = $_POST['usuario'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $confir_senha = $_POST['confirmar'];
        $descricao = $_POST['descricao'];

        // Verificando se as senhas coincidem
        if ($senha == $confir_senha) {
            try {
                // Preparando a consulta SQL
                $sql = "INSERT INTO cadastro (usuario, email, senha, descricao, confir_senha) VALUES (:usuario, :email, :senha, :descricao, :confir_senha)";
                $stmt = $conexao->prepare($sql);

                // Vinculando os parâmetros
                $stmt->bindParam(':usuario', $usuario);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':senha', $senha);
                $stmt->bindParam(':descricao', $descricao);
                $stmt->bindParam(':confir_senha', $confir_senha);

                // Executando a consulta
                $stmt->execute();

                // Redirecionando para a página de login
                header('Location: login.php');
                exit();
            } catch (PDOException $e) {
                // Exibindo mensagem de erro
                echo "Falha na inserção: " . $e->getMessage();
            }
        } else {
            echo "As senhas não coincidem. Tente novamente.";
        }
    } else {
        echo "Falha na Conexão: Conexão não foi estabelecida.";
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
            <form method="post" action="cadastro.php">
                <div class="card-inputs">
                    <div class="card-input">
                        <label for="usuario">Usuário</label>
                        <input class="wrap-input" type="text" name="usuario" id="usuario" required>
                    </div>
                    <div class="card-input">
                        <label for="email">E-mail</label>
                        <input class="wrap-input" type="email" name="email" id="email" required>
                    </div>
                    <div class="card-input">
                        <label for="senha">Senha</label>
                        <input class="wrap-input" type="password" name="senha" id="senha" required>
                    </div>
                    <div class="card-input">
                        <label for="confirmar">Confirmar Senha</label>
                        <input class="wrap-input" type="password" name="confirmar" id="confirmar" required>
                    </div>
                    <div class="nowrap-card-input">
                        <label for="descricao">Descrição</label>
                        <textarea maxlength="213" class="nowrap-input" name="descricao" id="descricao" required></textarea>
                    </div>
                </div>
                <input class="card-button" type="submit" name="submit" value="Registrar">
            </form>
         </div>
      </div>
   </div>
</body>
</html>

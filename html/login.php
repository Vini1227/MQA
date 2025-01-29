<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/login.css">
    <title>Login</title>
</head>
<body>
    <div class="container-login">
        <form action="./testlogin.php" method="post">
            <h1>Login</h1>
            <label for="usuário">Usuário:</label>
            <br>
            <input type="text" name="email" placeholder="Usuário" id="usuario">
            <br><br> 
            <label for="senha">Senha:</label>
            <br>
            <input type="password" name="senha" placeholder="senha" id="senha">
            <br><br>
            <div class="container-button">
                <a href="./cadastro.php">Cadastrar-se</a>
                <input type="submit" name="submit" id="submit" value="Entrar"> 
            </div> 
        </form>
    </div>
    <a href="./cadastro.php">Voltar</a>
</body>
</html>
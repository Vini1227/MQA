<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de ONG</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Krona+One&family=Lalezar&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <img class="v3" src="../imgs/MQA_whitewithtext.svg" alt="">
        <div class="link">
            <a href="#" id="b3">Login</a>
            <a href="#" id="b4">Sign-up</a>
        </div>
    </header>

    <div class="conteiner">
        <p>REGISTRE SUA ONG</p>
        <form action="cadastro_ong.php" method="POST"> <!-- action aponta para o arquivo PHP -->
            <div class="input1">
                <div class="grup">
                    <label>Nome *</label>
                    <input type="text" name="nome" required> <!-- name adicionado -->
                </div>
                <div class="grup">
                    <label>Senha</label>
                    <input type="password" name="senha" required> <!-- name adicionado -->
                </div>
            </div>

            <div class="input2">
                <div class="grup">
                    <label>E-mail</label>
                    <input type="email" name="email" required> <!-- name adicionado -->
                </div>
                <div class="grup">
                    <label>Confirmar Senha</label>
                    <input type="password" name="confirmar_senha" required> <!-- name adicionado -->
                </div>
            </div>

            <div class="cnpj">
                <div class="grup">
                    <label>CNPJ</label>
                    <input type="text" name="cnpj" required> <!-- name adicionado -->
                </div>
            </div>

            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>

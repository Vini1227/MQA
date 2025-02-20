<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="shortcut icon" href="../imgs/MQA_blue.svg" type="image/x-icon">
    <title>Login</title>
</head>
<body>
   <div class="app"> <!-- classe app é a div pai de toda pagina -->
      <div class="header">
         <div class="nav">
           <img class="mqa" src="../imgs/MQA_white.svg" alt="">
           <div class="nav-links"> <!-- links do header -->
           <a class="nav-link" href="">Login</a>
           <a class="nav-link" href="">Sign-up</a>
           </div>
         </div>
      </div>
      <div class="main"> <!-- parte principal da pagina -->
         <div class="login-card">
            <h1 class="card-title">Login</h1>
            <form action="./testlogin.php" method="post">
            <div class="card-input"> 
               <label for="nome">Email</label> <!-- input de nome de usuario -->
               <input type="text" name="email" id="email">
            </div>
            <div class="card-input"> 
               <label for="senha">Senha</label> <!-- input de senha -->
               <input type="password" name="senha" id="senha">
            </div>
            <input class="card-button" type="submit" name="submit" value="Entrar"> <!-- botão -->
         </div>
      </div>
   </div>
</body>
</html>
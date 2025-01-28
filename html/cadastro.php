<?php
  if(isset($_POST['submit'])){
      //print_r($_POST['email']);
      //print_r($_POST['usuario']);
      //print_r($_POST['senha']);
      //print_r($_POST['confirmar']);
      //print_r($_POST['descricao']);

      include_once('./config.php');

      $email = $_POST['email'];
      $usuario = $_POST['usuario'];
      $senha = $_POST['senha'];
      $confir_senha = $_POST['confirmar'];
      $descricao = $_POST['descricao'];

      if ($senha == $confir_senha) {

         $result = mysqli_query($conexao, "INSERT INTO cadastro(email,usuario,senha,descricao,confir_senha) VALUES ('$email','$usuario','$senha','$descricao','$confir_senha')");
  
         if($result){
          echo "cadastro realizado com sucesso!";
         }
         else{
         echo "as senhas nao coincidem tente novamente";
         }
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
    <title>Cadastro</title>
</head>
<body>
    <div class='container'>
        <div class='card'>
         <form action="./cadastro.php" method="post">
          <h1> Cadastrar </h1>
          
          <div id='msgError'></div>
          <div id='msgSuccess'></div>
          
                  <div class="label-float">
                     <input type="text" id="nome"
                     name="email" placeholder=" " required>
                     <label id="labelNome" for="nome">Email</label>
                  </div>
      
                  <div class="label-float">
                     <input type="text" name="usuario" id="usuario" placeholder=" " required>
                     <label id="labelUsuario" for="usuario">Usuário</label>
                  </div>
                  
                  <div class="label-float">
                     <input type="password" name="senha" id="senha" placeholder=" " required>
                     <label id="labelSenha" for="senha">Senha</label>
                     
                  </div>
      
                  <div class="label-float">
                     <input type="password" name="confirmar" id="confirmSenha" placeholder=" " required>
                     <label id="labelConfirmSenha" for="confirmSenha">Confirmar Senha</label>
                  </div>
                  
                  <div class="label-desc">
                    <input type="description" name="descricao" id="descricao" placeholder=" " required>
                    <label id="labeldescricao" for="descricao">Descrição:</label>
                 </div>

                  
                  <div class='justify-center'>
                  <input type="submit" id="submit" name="submit">
                  </div>
      
          
        </div>
      </form>
        </div>

     <script src="../js/cadastro.js"></script>
</body>
</html>
<?php

  session_start(); 

   //print_r($_REQUEST);
   if(isset($_POST['submit'])&& !empty($_POST['email']) && !empty($_POST['senha']))
   {
      require_once('config.php');
      $email = $_POST['email'];
      $senha = $_POST['senha'];

      //print_r('Email:'.$email);
      //print_r('<br>');
      //print_r('senha:'.$senha);

      $sql = "SELECT * FROM usuario WHERE email = :email AND senha = :senha";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      if($result){
        //print_r($usuario);
        $_SESSION['usuario'] = [
          'id' => $result['id'],
          'email' => $result['email'],
          'nome' => $result['nome'],
          'imagem' => $result['imagem'],
          'descricao' => $result['descricao']
        ];

      //print_r($result);
        //echo "Login efetuado com sucesso";
        header('Location:user_logado.php');
        exit();
      }
      else{
        echo "<script>alert('Login ou Senha Incorretos!');</script>";
        echo "<script>window.location.href='login.php';</script>";
        exit();
      }
   }
?>
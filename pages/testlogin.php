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

      $sql = "SELECT * FROM cadastro WHERE email = :email AND senha = :senha";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      //print_r($result);

      if($result){
        $_SESSION['email'] = $email;
        //echo "Login efetuado com sucesso";
        header('Location:sistema.php');
        exit();
      }
      else{
        echo "Login ou senha incorretos";
      }
   }
?>
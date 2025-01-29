<?php

   //print_r($_REQUEST);
   if(isset($_POST['submit'])&& !empty($_POST['email']) && !empty($_POST['senha']))
   {
      include_once('config.php');
      $email = $_POST['email'];
      $senha = $_POST['senha'];

      //print_r('Email:'.$email);
      //print_r('<br>');
      //print_r('senha:'.$senha);

      $sql = "SELECT * FROM cadastro WHERE email = '$email' and senha = '$senha'";

      $result = $conexao->query($sql);

      //print_r($result);

      if(mysqli_num_rows($result)<1){
        header('Location: login.php');
      }
      else{
        header('Location:sistema.php');
      }
   }
   else
   {
     header('Location:login.php');
   }
?>
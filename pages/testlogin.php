<?php
session_start();

if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
   require_once('config.php');
   $email = $_POST['email'];
   $senha = $_POST['senha'];

   // Tentar fazer o login como "usuário" primeiro
   $sql_usuario = "SELECT * FROM usuario WHERE email = :email AND senha = :senha";
   $stmt_usuario = $pdo->prepare($sql_usuario);
   $stmt_usuario->bindParam(':email', $email, PDO::PARAM_STR);
   $stmt_usuario->bindParam(':senha', $senha, PDO::PARAM_STR);
   $stmt_usuario->execute();
   $result_usuario = $stmt_usuario->fetch(PDO::FETCH_ASSOC);

   // Se encontrar o usuário
   if ($result_usuario) {
       $_SESSION['usuario'] = [
           'id' => $result_usuario['id'],
           'email' => $result_usuario['email'],
           'nome' => $result_usuario['nome'],
           'imagem' => $result_usuario['imagem'] ?? null // Se imagem não existe, evita erro
       ];

       header('Location: user_logado.php'); // Redireciona para a página do usuário logado
       exit();
   } else {
       // Se não encontrar um usuário, tenta fazer login como "ONG"
       $sql_ong = "SELECT * FROM ongs WHERE email = :email AND senha = :senha";
       $stmt_ong = $pdo->prepare($sql_ong);
       $stmt_ong->bindParam(':email', $email, PDO::PARAM_STR);
       $stmt_ong->bindParam(':senha', $senha, PDO::PARAM_STR);
       $stmt_ong->execute();
       $result_ong = $stmt_ong->fetch(PDO::FETCH_ASSOC);

       // Se encontrar a ONG
       if ($result_ong) {
           $_SESSION['ong'] = [
               'id' => $result_ong['id'],
               'email' => $result_ong['email'],
               'nome' => $result_ong['nome'],
               'descricao' => $result_ong['descricao'] ?? null // Se descrição não existe, evita erro
           ];

           header('Location: cadastromonetarioproduto.php'); // Redireciona para a página da ONG logada
           exit();
       } else {
           // Se não encontrar nem usuário nem ONG
           echo "<script>alert('Login ou Senha Incorretos!');</script>";
           echo "<script>window.location.href='login.php';</script>";
           exit();
       }
   }
}
?>


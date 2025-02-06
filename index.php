<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="shortcut icon" href="../imgs/MQA_blue.svg" type="image/x-icon">
    <title>Home</title>
</head>
<body>
   <div class="app"> <!-- classe app é a div pai de toda pagina -->
      <div class="header">
         <div class="nav">
           <img class="mqa" src="../imgs/MQA_white.svg" alt="">
           <div class="nav-links"> <!-- links do header -->
           <a class="nav-link" href="../html/Login.php">Login</a>
           <a class="nav-link" href="../html/cadastro.php">Sign-up</a>
           </div>
         </div>
      </div>
      <div class="main"> <!-- parte principal da pagina -->
         <div class="search-container"> <!-- Barra de Pesquisa -->
             <form action="/search" method="GET">
                 <input type="text" name="query" placeholder="Pesquise...">
                 <button type="submit"><i class="fa fa-search"></i></button>
             </form>
         </div>
      </div>
   </div>
</body>
</html>

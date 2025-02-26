<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home-Page</title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="app"> <!-- classe app é a div pai de toda pagina -->
      <div class="header">
         <div class="nav">
           <img class="mqa" src="../imgs/MQA_white.svg" alt="">
           <div class="nav-links"> <!-- links do header -->
           <a class="nav-link" href="../html/login.php">Login</a>
           <a class="nav-link" href="../html/cadastro.php">Sign-up</a>
           </div>
         </div>
      </div>

    <div class="carrossel">
    </div>

    <!--cadastramento-->
    <div class="box">

        <div class="img"><img src="../imgs/home_img1.png" alt=""></div>

        <div class="texto"><h1>Faça seu cadastro de acordo ...</h1>
            <br><br>
            <p>Com apenas alguns passos você estará pronto para doar.
            <br><br>
            e se você for um ... clicando em acessar estará apto a fazer
            a cadastrar sua ONG, instituição ou associação sem fins
            lucrativos.
            </p>

            <button class="botao">Acessar</button>
        </div>
        
    </div>
    <!--fim cadastramento-->

    <!--Início dos CARDS-->

    <div class="cards">

        <h1 class="relH1">Relatos de Doadores</h1>

        <button class="next"><img src="img/next-left.png" alt=""></button>

        <div class="card">
            <img src="img/img_user.png" alt="">
            <h3>NOME</h3>
            <p class="text-user">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <div class="star">
                <ul>
                    <li><i class="fa fa-star checked"></i></li>
                    <li><i class="fa fa-star checked"></i></li>
                    <li><i class="fa fa-star checked"></i></li>
                    <li><i class="fa fa-star checked"></i></li>
                    <li><i class="fa fa-star-o"></i></li>
                </ul>
            </div>
        </div>

        <div class="card">
            <img src="img/img_user.png" alt="">
            <h3>NOME</h3>
            <p class="text-user">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <div class="star">
                <ul>
                    <li><i class="fa fa-star checked"></i></li>
                    <li><i class="fa fa-star checked"></i></li>
                    <li><i class="fa fa-star checked"></i></li>
                    <li><i class="fa fa-star checked"></i></li>
                    <li><i class="fa fa-star-o"></i></li>
                </ul>
            </div>
        </div>

        <div class="card">
            <img src="img/img_user.png" alt="">
            <h3>NOME</h3>
            <p class="text-user">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <div class="star">
                <ul>
                    <li><i class="fa fa-star checked"></i></li>
                    <li><i class="fa fa-star checked"></i></li>
                    <li><i class="fa fa-star checked"></i></li>
                    <li><i class="fa fa-star checked"></i></li>
                    <li><i class="fa fa-star-o"></i></li>
                </ul>
            </div>
        </div>

        <button class="next"><img src="img/next-right.png" alt=""></button>

    </div>

    <!--Fim dos CARDS-->

    <!--inicio sobre nós-->
    <div class="box2">
        <div class="sobre">
            
            <h1>Quem somos nós ?</h1>
            <br><br>
            <p>123</p>
            <button class="botao2">Sobre Nós</button>
        </div>

        <div class="img02">
            <img src="../imgs/home_img2.png" alt="">
        </div>
    </div>
    <!--fim sobre nós-->

    <footer></footer>

</body>
</html>
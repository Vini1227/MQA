<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/cadastromonetarioproduto.css">
    <link rel="shortcut icon" href="../imgs/MQA_blue.svg" type="image/x-icon">
    <title>Editar Cadastro</title>
</head>
<body>
    <div class="app">
        <div class="header">
            <div class="nav">
                <img class="mqa" src="../imgs/MQA_whitewithtext.svg" alt="">
            </div>
        </div>  
        <div class="banner-perf-box">
            <img class="banner-do-perfil" src="../imgs/banner.png">
        </div>
        <div class="img-perf-box">
            <img class="imagem-do-perfil" src="../imgs/avatar.png">
        </div>
        <div class="cad-monprod-box">
            <h1 class="titulos">Descrição</h1>
            <textarea class="textarea-descricao"></textarea>
            <p class="titulos">Tipos de Doações Aceitas:</p>
            <div class="row-box">
                <div class="box-da-checkbox">
                    <p class="titulos titulos-var1">Dinheiro</p>
                    <input type="checkbox" id="checkbox1" class="checkbox" name="checkbox1" value="valor1">
                </div>
                <div class="box-da-checkbox">
                    <p class="titulos titulos-var1">Itens</p>
                    <input type="checkbox" id="checkbox1" class="checkbox" name="checkbox1" value="valor1">
                </div>
            </div>
            <div>
                <details class="details-box">
                    <summary class="titulos titulos-var1">Cadastro Monetário</summary>
                    <img src="../imgs/pix.png" alt="simbolo do pix" class="pix-imagem">
                    <p class="titulos titulos-varPix">Pix</p>
                    <input type="text" class="pix-textbox">
                    <p class="titulos titulos-varBanco">Banco</p>
                    <p class="subtitulos">Agência</p>
                    <input type="text" class="banco-textbox">
                    <p class="subtitulos">CNPJ</p>
                    <input type="text" class="banco-textbox">
                    <p class="subtitulos">Código da Conta</p>
                    <input type="text" class="banco-textbox">
                    <p class="subtitulos">Nome do Banco</p>
                    <input type="text" class="banco-textbox">
                    <p class="subtitulos">Tipo da Conta</p>
                    <input type="text" class="banco-textbox">
                    <div class="salvarEsquecer-box">
                        <button class="button">
                            <p class="titulos titulos-varEsqSalvar">Esquecer</p>
                        </button>
                        <button class="button">
                            <p class="titulos titulos-varEsqSalvar">Salvar</p>
                        </button>
                    </div>
                </details>
            </div>
            <div>
                <details class="details-box">
                    <summary class="titulos titulos-var1">Lista de Itens</summary>
                    <table class="nomeTipo-box">
                        <tr>
                            <th><div class="celula">Nome</div></th>
                            <th><div class="celula">Tipo</div></th>
                        </tr>
                        <tr>
                            <td><div class="celula">Carne</div></td>
                            <td><div class="celula">Alimento</div></td>
                        </tr>
                    </table>
                </details>
            </div>
        </div>
    </div>
</body>
     
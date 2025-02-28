<?php
// Captura os dados enviados pelo formulário
$dadosRecebidos = false; // Controle para verificar se há dados

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = htmlspecialchars($_POST['nome'] ?? 'Anônimo'); // Nome do doador, valor padrão "Anônimo"
    $item = htmlspecialchars($_POST['item'] ?? ''); // Item doado
    $quantidade = htmlspecialchars($_POST['quantidade'] ?? ''); // Quantidade doada
    $descricao = htmlspecialchars($_POST['descricao'] ?? ''); // Descrição do item

    // Verificar se um item válido foi selecionado
    if (!empty($item)) {
        $dadosRecebidos = true; // Dados válidos foram enviados
    }
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/visao_ong.css">
    <link rel="shortcut icon" href="../imgs/MQA_blue.svg" type="image/x-icon">
    <title>Visão ONG</title>
</head>
<body>
    <div class="app">
        <div class="header">
            <div class="nav">
                <img class="mqa" src="../imgs/MQA_whitewithtext.svg" alt="Logo">
            </div>
        </div>  

        <div class="banner-perf-box">
            <img class="banner-do-perfil" src="../imgs/banner.png" alt="Banner">
        </div>

        <div class="img-perf-box">
            <img class="img-do-perfil" src="../imgs/avatar.png" alt="Perfil">
        </div>

        <div class="main">
            <h1 class="text-do-perfil">Doações Realizadas</h1>

            <div class="tabela-doacoes"> 
                <table>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>
                                <img class="icone" src="../imgs/produto.png" alt="icone-produto">
                                Item
                            </th>
                            <th>Quantidade</th>
                            <th>
                                Descrição
                            </th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($dadosRecebidos) {
                            // Exibir os dados recebidos em uma linha da tabela
                            echo "<tr>
                                <td>
                                    <img class='img-do-perfil' src='../imgs/avatar.png' alt='Perfil'>
                                    $nome
                                </td>
                                <td>$item</td>
                                <td>$quantidade</td>
                                <td>$descricao</td>
                            </tr>";
                        } else {
                            // Mensagem de nenhum dado recebido
                            echo "<tr>
                                <td colspan='4'>Nenhum dado válido foi enviado.</td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div> 
    </div>
</body>
</html>


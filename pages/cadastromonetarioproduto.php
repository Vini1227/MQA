<?php
session_start();
require_once('config.php');

// Verifica se o usuário está logado pelo email
if (!isset($_SESSION['email'])) {
    echo "<script>alert('Você precisa estar logado para acessar esta página!');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

$email = $_SESSION['email']; // Recupera o email da sessão

// Busca o ID do usuário com base no email
$sqlUsuario = "SELECT id FROM usuario WHERE email = :email";
$stmt = $pdo->prepare($sqlUsuario);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "<script>alert('Usuário não encontrado!');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

$usuario_id = $usuario['id']; // Define o ID do usuário logado

// Busca os itens cadastrados pelo usuário
$sqlItens = "SELECT id, nome, tipo, descricao FROM itens WHERE usuario_id = :usuario_id";
$stmtItens = $pdo->prepare($sqlItens);
$stmtItens->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
$stmtItens->execute();
$itens = $stmtItens->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/cadastromonetarioproduto.css">
    <link rel="shortcut icon" href="../imgs/MQA_blue.svg" type="image/x-icon">
    <script src="../js/cadastromonetarioproduto.js" defer></script>
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
                    <div id="visualizar">
                        <table class="nomeTipo-box">
                            <tr>
                                <th><div class="celula">Nome</div></th>
                                <th><div class="celula">Tipo</div></th>
                            </tr>
                        <?php foreach ($itens as $item): ?>
                            <tr>
                                <td><div class="celula"><?php echo htmlspecialchars($item['nome']); ?></div></td>
                                <td><div class="celula"><?php echo htmlspecialchars($item['tipo']); ?></div></td>
                            </tr>
                        <?php endforeach; ?>
                        </table>
                        <div class="salvarEsquecer-box">
                            <button class="button" id="botaoEditar">
                                <p class="titulos titulos-varEsqSalvar">Editar</p>
                            </button>
                            <button class="button" id="botaoAdicionar">
                                <p class="titulos titulos-varEsqSalvar">Adicionar</p>
                            </button>
                        </div>
                    </div>
                    <form action="adicionar_item.php" method="POST">
                    <div id="adicionar">
                        <div>
                            <p class="titulos subtitulos" id="nome">Nome</p>
                            <input type="text" class="banco-textbox" name="nome">
                        </div>
                        <div>
                            <p class="titulos subtitulos" id="tipo">Tipo do Produto</p>
                            <input type="text" class="banco-textbox" name="tipo">
                        </div>
                        <div>
                            <p class="titulos subtitulos" id="descricao">Descrição</p>
                            <textarea class="desc-produto" name="descricao"></textarea>
                        </div>
                        <div class="salvarEsquecer-box">
                            <button class="button" type="button">
                                <p class="titulos titulos-varEsqSalvar" id="adicionarEsquecer">Esquecer</p>
                            </button>
                            <button type="submit" class="button" id="adicionarSalvar">
                                <p class="titulos titulos-varEsqSalvar">Salvar</p>
                            </button>
                        </div>
                    </div>
                    </form>
                    <div id="atualizar" style="display: none;">
                        <h1 class="titulos">Atualizar Item</h1>
                        <form id="formAtualizar" action="atualizar_item.php" method="POST">
                            <input type="hidden" name="id" id="atualizar-id">
                            
                            <p class="titulos subtitulos">Nome</p>
                            <input type="text" class="banco-textbox" name="nome" id="atualizar-nome">
                            
                            <p class="titulos subtitulos">Tipo</p>
                            <input type="text" class="banco-textbox" name="tipo" id="atualizar-tipo">
                            
                            <p class="titulos subtitulos">Descrição</p>
                            <textarea class="desc-produto" name="descricao" id="atualizar-descricao"></textarea>
                            
                            <div class="salvarEsquecer-box">
                                <button type="button" class="button" id="atualizarVoltar">
                                    <p class="titulos titulos-varEsqSalvar">Cancelar</p>
                                </button>
                                <button type="submit" class="button">
                                    <p class="titulos titulos-varEsqSalvar">Salvar</p>
                                </button>
                            </div>
                        </form>
                    </div>
                    </form>
                    <div id="editar">
                        <table class="nomeTipo-box">
                            <tr>
                                <th><div class="celula">Nome</div></th>
                                <th><div class="celula">Tipo</div></th>
                            </tr>
                        <?php foreach ($itens as $item): ?>
                            <tr>
                                <td><div class="celula"><?php echo htmlspecialchars($item['nome']); ?></div></td>
                                <td><div class="celula"><?php echo htmlspecialchars($item['tipo']); ?></div></td>
                                <td>
                                    <a class="botao-deletareditar" href="deletar_item.php?id=<?php echo $item['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este item?');">
                                    <img id="lixo" src="\imgs\trashcan.png" alt="Imagem 1">
                                    </a>
                                </td>
                                <td>
                                    <button class="botao-atualizar botao-deletareditar" onclick="atualizarItem(
                                        <?php echo $item['id']; ?>, 
                                        '<?php echo isset($item['nome']) ? htmlspecialchars($item['nome'], ENT_QUOTES, 'UTF-8') : ''; ?>', 
                                        '<?php echo isset($item['tipo']) ? htmlspecialchars($item['tipo'], ENT_QUOTES, 'UTF-8') : ''; ?>', 
                                        '<?php echo isset($item['descricao']) ? htmlspecialchars($item['descricao'], ENT_QUOTES, 'UTF-8') : ''; ?>'
                                    )">
                                        <img src="\imgs\edit.png" alt="Imagem 1">
                                    </button>
                                    
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </table>
                        <div class="salvarEsquecer-box">
                            <button class="button" id="editarVoltar">
                                <p class="titulos titulos-varEsqSalvar">Editar</p>
                            </button>
                        </div>
                    </div>
                </details>
            </div>
        </div>
    </div>
</body>
</html>
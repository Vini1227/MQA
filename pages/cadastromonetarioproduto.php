<?php
session_start();
require_once('config.php');

// Verifica se a ONG está logada
if (!isset($_SESSION['ong'])) {
    echo "<script>alert('Você precisa estar logado para acessar esta página!');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

// Recupera o e-mail da ONG a partir da sessão
$email = $_SESSION['ong']['email']; // Agora estamos acessando corretamente a sessão da ONG

// Busca o ID da ONG com base no email
$sqlOng = "SELECT id FROM ongs WHERE email = :email";
$stmt = $pdo->prepare($sqlOng);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->execute();
$ong = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$ong) {
    echo "<script>alert('ONG não encontrada!');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

$ong_id = $ong['id']; // Define o ID da ONG logada

// Verifica se já existe um cadastro monetário para essa ONG
$sqlVerificaCadastro = "SELECT * FROM cadastro_monetario WHERE ong_id = :ong_id";
$stmtVerifica = $pdo->prepare($sqlVerificaCadastro);
$stmtVerifica->bindParam(':ong_id', $ong_id, PDO::PARAM_INT);
$stmtVerifica->execute();
$cadastroExistente = $stmtVerifica->fetch(PDO::FETCH_ASSOC);

// Processa o formulário ao enviar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pix = $_POST['pix'] ?? null;
    $agencia = $_POST['agencia'] ?? null;
    $cnpj = $_POST['cnpj'] ?? null;
    $codigo_conta = $_POST['codigo_conta'] ?? null;
    $nome_banco = $_POST['nome_banco'] ?? null;
    $tipo_conta = $_POST['tipo_conta'] ?? null;

    try {
        if ($cadastroExistente) {
            // Se já existe um cadastro monetário para esta ONG, fazemos a atualização
            $sqlUpdate = "UPDATE cadastro_monetario 
                          SET pix = :pix, agencia = :agencia, cnpj = :cnpj, codigo_conta = :codigo_conta, 
                              nome_banco = :nome_banco, tipo_conta = :tipo_conta
                          WHERE ong_id = :ong_id";
            $stmtUpdate = $pdo->prepare($sqlUpdate);
            $stmtUpdate->bindParam(':pix', $pix, PDO::PARAM_STR);
            $stmtUpdate->bindParam(':agencia', $agencia, PDO::PARAM_STR);
            $stmtUpdate->bindParam(':cnpj', $cnpj, PDO::PARAM_STR);
            $stmtUpdate->bindParam(':codigo_conta', $codigo_conta, PDO::PARAM_STR);
            $stmtUpdate->bindParam(':nome_banco', $nome_banco, PDO::PARAM_STR);
            $stmtUpdate->bindParam(':tipo_conta', $tipo_conta, PDO::PARAM_STR);
            $stmtUpdate->bindParam(':ong_id', $ong_id, PDO::PARAM_INT);
            $stmtUpdate->execute();

            echo "<script>alert('Cadastro Monetário atualizado com sucesso!');</script>";
        } else {
            // Se não existe, inserimos o novo cadastro
            $sqlInsert = "INSERT INTO cadastro_monetario (ong_id, pix, agencia, cnpj, codigo_conta, nome_banco, tipo_conta)
                          VALUES (:ong_id, :pix, :agencia, :cnpj, :codigo_conta, :nome_banco, :tipo_conta)";
            $stmtInsert = $pdo->prepare($sqlInsert);
            $stmtInsert->bindParam(':ong_id', $ong_id, PDO::PARAM_INT);
            $stmtInsert->bindParam(':pix', $pix, PDO::PARAM_STR);
            $stmtInsert->bindParam(':agencia', $agencia, PDO::PARAM_STR);
            $stmtInsert->bindParam(':cnpj', $cnpj, PDO::PARAM_STR);
            $stmtInsert->bindParam(':codigo_conta', $codigo_conta, PDO::PARAM_STR);
            $stmtInsert->bindParam(':nome_banco', $nome_banco, PDO::PARAM_STR);
            $stmtInsert->bindParam(':tipo_conta', $tipo_conta, PDO::PARAM_STR);
            $stmtInsert->execute();

            echo "<script>alert('Cadastro Monetário realizado com sucesso!');</script>";
        }

        // Redireciona após salvar
        echo "<script>window.location.href='cadastromonetarioproduto.php';</script>";
    } catch (PDOException $e) {
        echo "Erro ao salvar os dados: " . $e->getMessage();
    }
}

// Exibir dados existentes (caso haja) no formulário
if ($cadastroExistente) {
    $pix = $cadastroExistente['pix'];
    $agencia = $cadastroExistente['agencia'];
    $cnpj = $cadastroExistente['cnpj'];
    $codigo_conta = $cadastroExistente['codigo_conta'];
    $nome_banco = $cadastroExistente['nome_banco'];
    $tipo_conta = $cadastroExistente['tipo_conta'];
} else {
    $pix = $agencia = $cnpj = $codigo_conta = $nome_banco = $tipo_conta = '';
}

// Busca os itens cadastrados pela ONG
$sqlItens = "SELECT id, nome, tipo, descricao FROM itens WHERE ong_id = :ong_id";
$stmtItens = $pdo->prepare($sqlItens);
$stmtItens->bindParam(':ong_id', $ong_id, PDO::PARAM_INT);
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
            <textarea class="textarea-descricao" name="descricao" id="descricao" autocomplete="on"></textarea>
            <p class="titulos">Tipos de Doações Aceitas:</p>
            <div class="row-box">
                <div class="box-da-checkbox">
                    <p class="titulos titulos-var1">Dinheiro</p>
                    <input type="checkbox" id="checkboxDinheiro" class="checkbox" name="checkboxTipo[]" value="dinheiro" autocomplete="off">
                </div>
                <div class="box-da-checkbox">
                    <p class="titulos titulos-var1">Itens</p>
                    <input type="checkbox" id="checkboxItens" class="checkbox" name="checkboxTipo[]" value="itens" autocomplete="off">
                </div>
            </div>
            <form method="POST" action="cadastromonetarioproduto.php">
    <details class="details-box">
        <summary class="titulos titulos-var1">Cadastro Monetário</summary>
        <img src="../imgs/pix.png" alt="simbolo do pix" class="pix-imagem">

        <p class="titulos titulos-varPix">Pix</p>
        <input type="text" class="pix-textbox" name="pix" id="pix" autocomplete="off" value="<?php echo htmlspecialchars($pix); ?>">

        <p class="titulos titulos-varBanco">Banco</p>

        <p class="subtitulos">Agência</p>
        <input type="text" class="banco-textbox" name="agencia" id="agencia" autocomplete="off" value="<?php echo htmlspecialchars($agencia); ?>">

        <p class="subtitulos">CNPJ</p>
        <input type="text" class="banco-textbox" name="cnpj" id="cnpj" autocomplete="off" value="<?php echo htmlspecialchars($cnpj); ?>">

        <p class="subtitulos">Código da Conta</p>
        <input type="text" class="banco-textbox" name="codigo_conta" id="codigo_conta" autocomplete="off" value="<?php echo htmlspecialchars($codigo_conta); ?>">

        <p class="subtitulos">Nome do Banco</p>
        <input type="text" class="banco-textbox" name="nome_banco" id="nome_banco" autocomplete="off" value="<?php echo htmlspecialchars($nome_banco); ?>">

        <p class="subtitulos">Tipo da Conta</p>
        <input type="text" class="banco-textbox" name="tipo_conta" id="tipo_conta" autocomplete="off" value="<?php echo htmlspecialchars($tipo_conta); ?>">

        <div class="salvarEsquecer-box">
            <button type="reset" class="button">
                <p class="titulos titulos-varEsqSalvar">Esquecer</p>
            </button>
            <button type="submit" class="button">
                <p class="titulos titulos-varEsqSalvar">Salvar</p>
            </button>
        </div>
    </details>
</form>
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
                            <label for="nome" class="subtitulos">Nome</label>
                            <input type="text" class="banco-textbox" name="nome" id="nome" autocomplete="on">
                        </div>
                        <div>
                            <label for="tipo" class="subtitulos">Tipo do Produto</label>
                            <input type="text" class="banco-textbox" name="tipo" id="tipo" autocomplete="on">
                        </div>
                        <div>
                            <label for="descricao" class="subtitulos">Descrição</label>
                            <textarea class="desc-produto" name="descricao" id="descricao" autocomplete="on"></textarea>
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
                            
                            <label for="atualizar-nome" class="subtitulos">Nome</label>
                            <input type="text" class="banco-textbox" name="nome" id="atualizar-nome" autocomplete="on">
                            
                            <label for="atualizar-tipo" class="subtitulos">Tipo</label>
                            <input type="text" class="banco-textbox" name="tipo" id="atualizar-tipo" autocomplete="on">
                            
                            <label for="atualizar-descricao" class="subtitulos">Descrição</label>
                            <textarea class="desc-produto" name="descricao" id="atualizar-descricao" autocomplete="on"></textarea>
                            
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

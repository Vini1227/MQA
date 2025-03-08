<?php
//session_start(); 

require_once('config.php');

$sql = "SELECT * FROM usuario ORDER BY id ";
$stmt = $pdo->prepare($sql);
$stmt->execute(); 
$result = $stmt->fetchAll(PDO::FETCH_ASSOC); 

//print_r($result)
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/sistema.css">
    <link rel="shortcut icon" href="../imgs/MQA_blue.svg" type="image/x-icon">
    <title>Sistema</title>
</head>
<body>
    <h1>Acessou o Sistema</h1>
    <a href="./logout.php">Sair</a>
    <div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Senha</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($stmt->rowCount() > 0) {
               foreach($result as $row) {
                     echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nome']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['senha']}</td>
                            <td>{$row['descricao']}</td>
                            <td>
                                <a href='update.php?id={$row['id']}'>Editar</a> &nbsp; | &nbsp;

                                <a href='delete.php?id={$row['id']}' class='delete-btn' onclick='return confirm(\"Tem certeza que deseja excluir este registro?\")'>Excluir</a>
                                <a href='cadastromonetarioproduto.php?id={$row['id']}'>Cadastro Monetário</a>
                            </td>
                          </tr>";
                }
            } 
            else {
                echo "<tr><td colspan='7'>Nenhum usuário encontrado</td></tr>";
            }
            ?>
        </tbody>
    </table>
    </div>
    
</body>
</html>
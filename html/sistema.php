<?php
require_once('config.php');

$sql = "SELECT * FROM cadastro ORDER BY id ";
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
    <title>Sistema</title>
</head>
<body>
    <h1>Acessou o Sistema</h1>
    <div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuário</th>
                <th>Email</th>
                <th>Senha</th>
                <th>confirmar</th>
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
                            <td>{$row['usuario']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['senha']}</td>
                            <td>{$row['confir_senha']}</td>
                            <td>{$row['descricao']}</td>
                        <td>
                                <a href='delete.php?id={$row['id']}' class='delete-btn' onclick='return confirm(\"Tem certeza que deseja excluir este registro?\")'>Excluir</a>
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

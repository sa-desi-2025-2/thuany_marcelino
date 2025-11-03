<?php

require_once "../../Backend/Classes/Conexao.php";
require_once "../../Backend/Classes/Usuario.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuários</title>
</head>

<body>
    <table border="1">
        <thead>
            <th>NOME</th>
            <th>NOME DE USUÁRIO</th>
            <th>EMAIL</th>
            <th>TIPO DE ACESSO</th>
            <th>STATUS</th>
            <th>AÇÕES</th>
        </thead>
        <tbody>
            <?php
            if (isset($Usuarios) && is_array($Usuarios)) {

                foreach ($Usuarios as $Usuario) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($Usuario["nome"]) . "</td>";
                    echo "<td>" . htmlspecialchars($Usuario["nome_usuario"]) . "</td>";
                    echo "<td>" . htmlspecialchars($Usuario["email"]) . "</td>";
                    echo "<td>" . htmlspecialchars($Usuario["tipo_acesso"]) . "</td>";
                    echo "<td>" . htmlspecialchars($Usuario["status_acesso"]) . "</td>";
                    echo "<td>";
                    echo "<input type= 'button' value= 'EDITAR'>";
                    if ($Usuario["status_acesso"] == "ATIVO") {
                        echo "<input type= 'button' value= 'DESABILITAR'>";
                    } else {
                        echo "<input type= 'button' value= 'HABILITAR'>";
                    }
                    echo "<td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan= '6'>Nenhum usuario enconstrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>

</html>
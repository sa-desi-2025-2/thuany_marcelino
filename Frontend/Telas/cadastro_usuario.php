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
    <!-- Esconde o botão salvar até ele ser chamado -->
    <style> 
        .btn-salvar {
            display: none; 
        }
    </style>
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
            // verifica se a variável existe e é um array (há dados para passar)
            if (isset($Usuarios) && is_array($Usuarios)) {

                foreach ($Usuarios as $Usuario) {
                    $usuario_id = htmlspecialchars($Usuario["id_usuario"] ?? uniqid('temp_'));
                    $nome = htmlspecialchars($Usuario["nome"] ?? '');
                    $nome_usuario = htmlspecialchars($Usuario["nome_usuario"] ?? '');
                    $email = htmlspecialchars($Usuario["email"] ?? '');
                    $tipo_acesso = htmlspecialchars($Usuario["tipo_acesso"] ?? 'USUARIO');
                    $status_acesso = htmlspecialchars($Usuario["status_acesso"] ?? '');
                    // para saber qual registro atualizar no banco+
                    echo "<tr data-id='{$usuario_id}'>"; 
                    echo "<td> <input type='text' class='campo-edicao' name='nome' value='{$nome}' disabled></td>";
                    echo "<td> <input type='text' class='campo-edicao' name='nome_usuario' value='{$nome_usuario}' disabled></td>";
                    echo "<td> <input type='email' class='campo-edicao' name='email' value='{$email}' disabled></td>";
                    echo "<td>";
                    echo "<select class='campo-edicao' name='tipo_acesso' disabled>";

                    $opcoes_acesso = ['USUÁRIO', 'ADMINISTRADOR'];
                    foreach ($opcoes_acesso as $opcao) {
                        $selected = ($tipo_acesso == $opcao) ? 'selected' : '';
                        echo "<option value='{$opcao}' {$selected}>{$opcao}</option>";
                    }
                    echo "</select>";
                    echo "</td>";
                    echo "<td>" . htmlspecialchars($status_acesso) . "</td>";
                    echo "<td>"; // Abrindo o <td> de AÇÕES
                    echo "<button type='button' class='btn-editar'>EDITAR</button>";
                    echo "<button type='button' class='btn-salvar'>SALVAR</button>";

                    if ($Usuario["status_acesso"] == "ATIVO") {
                        echo "<input type= 'button' value= 'DESABILITAR'>";
                    } else {
                        echo "<input type= 'button' value= 'HABILITAR'>";
                    }
                    echo "</td>"; // Fechando o <td> de AÇÕES
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Nenhum usuario encontrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <br>
    <button id="btn-novo-usuario">NOVO USUÁRIO</button>
    <script src="../../Frontend/Telas/js/update_usuario.js" defer></script>
</body>

</html>
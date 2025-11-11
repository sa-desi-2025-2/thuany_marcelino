<?php

require_once "../../Backend/Classes/Conexao.php";
require_once "../../Backend/Classes/Usuario.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Esconde o botão salvar até ele ser chamado -->
    <style>
        .btn-salvar {
            display: none;
        }
    </style>
</head>

<body style="height: 100vh; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; overflow: hidden;">

    <div class="container-fluid h-100">

        <!-- Início da Barra de navegação -->
        <nav class="navbar-top"
            style="display: flex; justify-content: flex-end; align-items: center; padding: 10px 20px; background-color: white; border-bottom: 1px solid #ccc;">
            <div style="display: flex; align-items: center; margin-right: auto;">
                <img src="../../logo_whp.png" alt="logo da whirlpool" width="150" height="50">
            </div>
            <div style="display: flex; gap: 20px; align-items: center;">
                <a href="../../Backend/Main/main_cadastro.php"
                    style="font-size: 17px; color: #333; text-decoration: none;"><i class="bi bi-person-gear"
                        style="font-size: 20px; margin-right: 5px;"></i> Gerenciar usuários</a>
                <!-- arrumar o direcionamento do link abaixo -->
                <a href="../../index.php" style="font-size: 17px; color: #333; text-decoration: none;"><i
                        class="bi bi-arrow-bar-left" style="font-size: 20px; margin-right: 5px;"></i> Sair</a>
            </div>
        </nav>
        <!-- Fim da Barra de navegação -->

        <div class="row h-100" style="flex: 1;">
            <div class="col" style="background-color: #0b3553; color: white;">
                <div class="d-flex flex-column justify-content-center align-items-center">
                <table class="table-secondary" style="background: #FFFFFF" border="1">
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
                </div>
                <br>
                <button id="btn-novo-usuario">NOVO USUÁRIO</button>
            </div>
        </div>
    </div>
    <script src="../../Frontend/Telas/js/update_usuario.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
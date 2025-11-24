<?php

require_once "../../../../Backend/Classes/Conexao.php";
require_once "../../../../Backend/Classes/Usuario.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrossel de Teste - Linha 2</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        /* Esconde o botão salvar até ele ser chamado */
        .btn-salvar {
            display: none;
        }
        /* Garantir que o conteúdo principal use o espaço restante verticalmente */
        .content-area {
            flex-grow: 1; /* Permite que ocupe todo o espaço disponível */
            overflow-y: auto; /* Adiciona barra de rolagem se o conteúdo for muito longo */
        }
    </style>
</head>

<body style="height: 100vh; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; display: flex; flex-direction: column;">

    <!-- Início da Barra de navegação -->
    <nav class="navbar-top"
        style="display: flex; justify-content: flex-end; align-items: center; padding: 10px 20px; background-color: white; border-bottom: 1px solid #ccc;">
        <div style="display: flex; align-items: center; margin-right: auto;">
            <img src="../../../../logo_whp.png" alt="logo da whirlpool" width="150" height="50">
        </div>
        <div style="display: flex; gap: 20px; align-items: center;">
            <a href="../../pagina_principal.php" style="font-size: 17px; color: #333; text-decoration: none;"><i
                    class="bi bi-arrow-return-left" style="font-size: 20px; margin-right: 5px;"></i> Voltar</a>
            <a href="../../../../index.php" style="font-size: 17px; color: #333; text-decoration: none;"><i
                    class="bi bi-arrow-bar-left" style="font-size: 20px; margin-right: 5px;"></i> Sair</a>
        </div>
    </nav>
    <!-- Fim da Barra de navegação -->

    <div class="maquina-header-bar" 
        style="background-color: #0b3553; color: white; padding: 15px 20px;">
        <h1 style="font-size: 2rem; margin: 0;">
            Linha 2 - Carrossel de Testes
        </h1>
    </div>

    <div class="container-fluid content-area p-4 bg-white">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-4">
                <div class="card p-3">EWO</div>
            </div>
            <div class="col-md-4 d-flex flex-column align-items-end">
                <div class="card p-3 mb-3 w-100">EWO nova, colocar no quadro!</div>
                <button class="btn btn-success">FEITO</button>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
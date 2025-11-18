<?php

require_once "../../../../Backend/Classes/Conexao.php";
require_once "../../../../Backend/Classes/Usuario.php";
require_once "../../../../Backend/Classes/Ewo.php";

$id_maquina = 16; 
$nome_maquina = "Linha 1 - Injetora de Gabinetes (seca)";

try {
    $conexao = new Conexao();
    $ewo = new Ewo();
    
    $todas_ewos = $ewo->buscarEwoMaquina($conexao, $id_maquina); 
    
    // Prepara o JSON para o JavaScript
    $ewos_json = json_encode($todas_ewos);
    
} catch (Exception $e) {
    // Tratamento de erro
    $erro = "Erro ao carregar dados: " . $e->getMessage();
    $ewos_json = '[]';
    $todas_ewos = [];
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($nome_maquina); ?></title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        .btn-salvar { display: none; }
        .content-area { flex-grow: 1; overflow-y: auto; }
        .ewo-nova { color: red; font-weight: bold; }
        .doc-icon { margin-right: 5px; color: #0b3553; font-size: 1rem; }
    </style>
</head>

<body style="height: 100vh; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; display: flex; flex-direction: column;">

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
    <div class="maquina-header-bar" 
        style="background-color: #0b3553; color: white; padding: 15px 20px;">
        <h1 style="font-size: 2rem; margin: 0;">
            <?php echo htmlspecialchars($nome_maquina); ?>
        </h1>
    </div>

    <div class="container-fluid content-area p-4 bg-white">
        
        <?php if (empty($todas_ewos)): ?>
            <div class="row justify-content-center mt-5">
                <div class="col-md-6">
                    <div class="card p-4 border border-danger text-center" style="color: red;">
                        <i class="bi bi-exclamation-octagon-fill" style="font-size: 2rem;"></i>
                        <p class="mb-0 mt-2" style="font-size: 1.2rem; font-weight: bold;">
                            Esta máquina não possui EWO
                        </p>
                        <button onclick="window.history.back();" class="btn btn-danger mt-3" style="width: 100px; margin: 0 auto;">OK</button>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <div class="row">
                <div class="col-md-2"></div>
                
                <div class="col-md-4">
                    <div class="card p-3">
                        <h5 class="card-title">EWO</h5>
                        <table class="table table-striped" id="tabela-existente">
                            <thead>
                                <!-- <tr><th>EWO</th></tr> -->
                            </thead>
                            <tbody>
                                </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="col-md-4 d-flex flex-column align-items-end">
                    <div class="card p-3 mb-3 w-100">
                        <h5 class="card-title">EWO nova, colocar no quadro!</h5>
                        <table class="table table-striped" id="tabela-nova">
                            <thead>
                                <!-- <tr><th>EWO nova, colocar no quadro!</th></tr> -->
                            </thead>
                            <tbody>
                                </tbody>
                        </table>
                    </div>
                    <button id="btn-feito" class="btn btn-success" style="display: none;">FEITO</button>
                </div>
                
                <div class="col-md-2"></div>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <?php if (!empty($todas_ewos)): ?>
        <script>
            const todasEwos = <?php echo $ewos_json; ?>;
            const MAQUINA_ID = <?php echo $id_maquina; ?>;
        </script>
        
        <script src="../../js/visualizacao_ewo.js"></script> 
    <?php endif; ?>

</body>
</html>
<?php

require_once __DIR__ . "/../../vendor/autoload.php";

require_once __DIR__ . "/../Classes/Conexao.php";
require_once __DIR__ . "/../Classes/Planilha.php";
require_once __DIR__ . "/../Classes/Maquina.php";
require_once __DIR__ . "/../Classes/Linha.php";
require_once __DIR__ . "/../Classes/Ewo.php";

use \Classes\GoogleSheetService; // importa a classe GoogleSheetsSerce do Planilha

$db = new Conexao();

$leitorPlanilha = new GoogleSheetService();
$idPlanilha = '19FPbSB4WxrAdRmdG_Xgc7MY5g6BvvAzI6Lwki7bUlEM';
$dadosPlanilha = $leitorPlanilha->lerPlanilha($idPlanilha);

$linhasDeDados = $dadosPlanilha['dados'];

foreach ($linhasDeDados as $i => $linhaAtual) {
    // IGNORA a primeira linha (cabeçalho da planilha)
    if ($i == 0) {
        continue;
    }

    // Verifica se a linha tem pelo menos a coluna EWO
    // Se a linha tiver menos de 3 colunas, é uma linha em branco ou mal formatada.
    if (count($linhaAtual) < 3) {
        continue;
    }

    // IGNORA a linha se o campo EWO [2] ou SETOR [7] estiver vazio
    if (empty($linhaAtual[2]) || empty($linhaAtual[7])) {
        continue;
    }
    $linha = new Linha();
    $maquina = new Maquina();
    $ewo = new Ewo();

    $linha->nome_linha = trim($linhaAtual[6]);

    $maquina->id_linha = $linha->selecionarOuInserir($db);
 
    $maquina->nome_maquina = trim($linhaAtual[4]);
    $ewo->id_maquina = $maquina->selecionarOuInserir($db);

    $ewo->numero_ewo = $linhaAtual[2];
    $ewo->link_documento = $linhaAtual[3];
    $ewo->inserirEwo($db);

}
?>
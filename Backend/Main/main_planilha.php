<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use \Classes\Planilha; // importa a classe GoogleSheetsSerce do Planilha
use \Classes\Conexao;

$db = new Conexao();

$leitorPlanilha->atualizarPlanilha();

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

    header('Location: /thuany_marcelino/index.php');
    exit();
?>
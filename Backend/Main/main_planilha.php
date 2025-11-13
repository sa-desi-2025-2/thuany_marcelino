<?php

require_once __DIR__ . "/../../vendor/autoload.php";

require_once __DIR__ . "/../Classes/Conexao.php";
require_once __DIR__ . "/../Classes/Planilha.php";
require_once __DIR__ . "/../Classes/Maquina.php";
require_once __DIR__ . "/../Classes/Linha.php";
require_once __DIR__ . "/../Classes/Ewo.php";


use \Classes\GoogleSheetService; // importa a classe GoogleSheetsSerce do Planilha


$leitorPlanilha = new GoogleSheetService();
$idPlanilha = '19FPbSB4WxrAdRmdG_Xgc7MY5g6BvvAzI6Lwki7bUlEM'; // define ID da planilha que quer ler

$dadosPlanilha = $leitorPlanilha->lerPlanilha($idPlanilha);


$maquina = new Maquina();
// var_dump($dadosPlanilha);
print_r($dadosPlanilha['dados'][3][2]);
die();


$maquina->inserirMaquina();


$linha = new Linha();
$linha->nome_linha = $dadosPlanilha['SETOR'];
$linha->inserirLinha();

$ewo = new Ewo();
$ewo->numero_ewo = $dadosPlanilha['EWO'];
$ewo->link_documento = $dadosPlanilha['EWO'];
$ewo->inserirEwo();

?>
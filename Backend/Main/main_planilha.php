<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use \Classes\Planilha; // importa a classe GoogleSheetsSerce do Planilha
use \Classes\Conexao;

$db = new Conexao();

$leitorPlanilha->atualizarPlanilha();

?>
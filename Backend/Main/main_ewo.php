<?php

require_once __DIR__ . "/../Classes/Conexao.php";
require_once __DIR__ . "/../Classes/Ewo.php";


$ewo = new Ewo();

$lista = $ewo->selecione();

require_once  "../../Frontend/Telas/ewo.php";
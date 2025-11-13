<?php

require_once __DIR__ . "/../Classes/Conexao.php";
require_once __DIR__ . "/../Classes/Maquina.php";


$Maquina = new Maquina();

$lista = $Maquina->inserirMaquina();

require_once "../../Frontend/Telas/maquina.php";

?>
<?php

require_once __DIR__ . "/../Classes/Conexao.php";
require_once __DIR__ . "/../Classes/Linha.php";


$Linha = new Linha();

$lista = $Linha->inserirLinha();

require_once "../../Frontend/Telas/linha.php";

?>
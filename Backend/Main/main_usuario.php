<?php

require_once __DIR__ . "/../Classes/Conexao.php";
require_once __DIR__ . "/../Classes/Usuario.php";
require_once "../../Frontend/Telas/usuario.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $nome_usuario = $_POST["nome_usuario"];
}


$novoUsuario = new Usuario($nome, $email, $nome_usuario);

$novoUsuario->inserir();


header("Location: ../../Frontend/Telas/usuario.php");

?>
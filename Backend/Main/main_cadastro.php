<?php
echo "<pre>Rodando arquivo: " . __FILE__ . "</pre>";


require_once __DIR__ . "/../Classes/Conexao.php";
require_once __DIR__ . "/../Classes/Usuario.php";

$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$nome_usuario = $_POST['nome_usuario'] ?? '';
$tipo_acesso = $_POST['tipo_acesso'] ?? '';
$status_acesso = $_POST['status_acesso'] ?? '';

$Usuario = new Usuario($nome, $email, $nome_usuario, $tipo_acesso, $status_acesso);

$Usuarios = $Usuario->buscarUsuarios();

require_once "../../Frontend/Telas/cadastro_usuario.php";

?>

<?php
use Classes\Conexao;
use Classes\Planilha;

session_start(); // inicia a sessao armazenando os dados que receber
require_once "../Classes/Conexao.php";
require_once "../Classes/Usuario.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") { // Verifica se foi enviado algo pelo formulário via método POST
    $nome_usuario = $_POST['nome_usuario'];
    $senha = $_POST['senha'];

    try {
        $con = new Conexao();
        $sql = "SELECT * FROM usuario WHERE nome_usuario = :nome_usuario";
        $stmt = $con->prepare($sql); // stmt variável que permite a execução segura da consulta com o banco de dados
        $stmt->bindParam(':nome_usuario', $nome_usuario); // vincula o valor ao placeholder
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            
            $senha_digitada = hash('sha256', $senha); // Verifica se a senha digitada (hash 256) é igual à do banco

            if ($senha_digitada === $usuario['senha']) {

                $_SESSION['usuario_id'] = $usuario['id_usuario'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                $_SESSION['usuario_tipo'] = $usuario['tipo_acesso'];
                $planilha = new Planilha();
                $planilha->atualizarPlanilha();
                header("Location: ../../Frontend/Telas/pagina_principal.php");
                exit;
            } else {

                $_SESSION['erro_login'] = "Senha incorreta!";
                header("Location: ../../index.php");
                exit;
            }
        } else {
            $_SESSION['erro_login'] = "Usuário não encontrado!";
            header("Location: ../../index.php");
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['erro_login'] = "Erro ao processar login: " . $e->getMessage();
        header("Location: ../../index.php");
        exit;
    }
} else {
    header("Location: ../../index.php");
    exit;
}
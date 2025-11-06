<?php
// define que vai responder os dados como JSON (tipo de texto para enviar os dados)
header('Content-Type: application/json');

require_once "../Classes/Conexao.php";
require_once "../Classes/Usuario.php";

// verifica se veio mesmo via POST e se os dois campos foram para o POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome'], $_POST['nome_usuario'], $_POST['email'], $_POST['tipo_acesso'])) {
    $usuario = new Usuario();

    // recebe os valores que vieram do POST
    $dados = [
        'nome' => $_POST['nome'],
        'nome_usuario' => $_POST['nome_usuario'],
        'email' => $_POST['email'],
        'tipo_acesso' => $_POST['tipo_acesso'],
        'status_acesso' => $_POST['status_acesso'] ?? 'ATIVO'
    ];

    try {
        $resultado = $usuario->inserirUsuario($dados);

        if ($resultado === true) {
            echo json_encode(['success' => true, 'message' => 'Usuário inserido com sucesso!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Falha ao inserir usuário.']);
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Dados incompletos.']);
}

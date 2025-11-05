<?php
// define que vai responder os dados como JSON não como HTML
header('Content-Type: application/json');
require_once "../Classes/Conexao.php";
require_once "../Classes/Usuario.php";

// verifica se veio mesmo via POST e se os dois campos foram para o POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['novo_status'])) {
    // extrai os dados
    $id = $_POST['id'];
    $novo_status = $_POST['novo_status'];

    try {
        $usuario = new Usuario();
        // chama método para alterar
        $resultado = $usuario->alterarStatus($id, $novo_status);

        if ($resultado === true) {
            echo json_encode(['success' => true, 'message' => "Status atualizado para {$novo_status}."]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao atualizar status.', 'detalhes' => $resultado]);
        }
        // para erros de conexao
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    // se não for POST cai no erro
} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Requisição inválida.']);
}

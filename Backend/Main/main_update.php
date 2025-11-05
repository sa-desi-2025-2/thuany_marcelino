<?php
header('Content-Type: application/json; charset=utf-8');

require_once "../Classes/Conexao.php";
require_once "../Classes/Usuario.php";

// Verifica método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método não permitido. Use POST.']);
    exit;
}

// Recebe dados
$id = $_POST['id'] ?? null;
$nome = $_POST['nome'] ?? '';
$nome_usuario = $_POST['nome_usuario'] ?? '';
$email = $_POST['email'] ?? '';
$tipo_acesso = $_POST['tipo_acesso'] ?? '';

// DEBUG: devolve os dados recebidos (útil em dev, remova em prod)
$dadosRecebidos = [
    'id' => $id,
    'nome' => $nome,
    'nome_usuario' => $nome_usuario,
    'email' => $email,
    'tipo_acesso' => $tipo_acesso
];

if (empty($id)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'ID do usuário não fornecido.', 'received' => $dadosRecebidos]);
    exit;
}

try {
    $usuario = new Usuario(); // construtor sem parâmetros (ajuste a classe se necessário)

    $resultado = $usuario->atualizarUsuarios($id, $nome, $nome_usuario, $email, $tipo_acesso);

    // Se o método retornar true/false
    if ($resultado === true) {
        http_response_code(200);
        echo json_encode(['success' => true, 'message' => 'Usuário atualizado com sucesso!', 'received' => $dadosRecebidos]);
        exit;
    } else {
        // Se o método retornou detalhes do erro (array) ou false
        http_response_code(500);
        // tenta pegar erro PDO se disponível (o método pode retornar array com errorInfo)
        if (is_array($resultado) && isset($resultado['errorInfo'])) {
            echo json_encode(['success' => false, 'message' => 'Erro ao executar UPDATE', 'pdo_error' => $resultado['errorInfo'], 'received' => $dadosRecebidos]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Falha ao atualizar (retorno falso).', 'received' => $dadosRecebidos]);
        }
        exit;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Exceção: ' . $e->getMessage(), 'received' => $dadosRecebidos]);
    exit;
}

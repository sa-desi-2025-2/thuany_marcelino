<?php
require __DIR__ . '/vendor/autoload.php';


use Google\Client;


$credentialsPath = __DIR__ . '/credentials.json';
$tokenPath = __DIR__ . '/token.json';


if (!file_exists($credentialsPath)) {
    exit('credentials.json não encontrado. Baixe do Google Cloud e coloque na raiz.');
}


$client = new Client();
$client->setApplicationName('Leitor de Planilhas');
$client->setScopes([
    Google\Service\Sheets::SPREADSHEETS_READONLY,
    Google\Service\Drive::DRIVE_READONLY,
]);
$client->setAccessType('offline');
$client->setPrompt('consent');
$client->setAuthConfig($credentialsPath);


$path = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$redirectUri = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') .
    '://' . $_SERVER['HTTP_HOST'] . $path . '/oauth.php';
$client->setRedirectUri($redirectUri);

if (!isset($_GET['code'])) {
    $authUrl = $client->createAuthUrl();
    header('Location: ' . $authUrl);
    exit;
} else {
    $authCode = $_GET['code'];
    $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);


    if (isset($accessToken['error'])) {
        exit('Erro ao obter token: ' . htmlspecialchars($accessToken['error_description'] ?? $accessToken['error']));
    }


    // Salva token
    file_put_contents($tokenPath, json_encode($accessToken));


    echo '<h2>Autenticação concluída!</h2><p>O token foi salvo em token.json. Volte ao sistema e tente ler a planilha novamente.</p>';
}
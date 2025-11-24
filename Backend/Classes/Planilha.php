<?php
namespace Classes;


use Google\Client;
use Google\Service\Sheets;


class GoogleSheetService
{
    private string $credentialsPath;
    private string $tokenPath;


    public function __construct()
    {
        $this->credentialsPath = dirname(__DIR__) . '../../credentials.json';
        $this->tokenPath = dirname(__DIR__) . '../../token.json';
    }


    private function getClient(): Client
    {
        
        if (!file_exists($this->credentialsPath)) {
            $e = new \Exception('credentials.json não encontrado.');
            $e->authUrl = null;
            throw $e;
        }

        $client = new Client();
        $client->setApplicationName('Leitor de Planilhas');
        $client->setScopes([
            Sheets::SPREADSHEETS_READONLY,
        ]);
        $client->setAccessType('offline');
        $client->setPrompt('consent');
        $client->setAuthConfig($this->credentialsPath);


        // Define redirect para oauth.php
        $scheme = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
        $redirectUri = $scheme . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '../../oauth.php';
        $client->setRedirectUri($redirectUri);


        if (file_exists($this->tokenPath)) {
            $accessToken = json_decode(file_get_contents($this->tokenPath), true);
            $client->setAccessToken($accessToken);


            if ($client->isAccessTokenExpired()) {
                if ($client->getRefreshToken()) {
                    $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                    file_put_contents($this->tokenPath, json_encode($client->getAccessToken()));
                } else {
                    $authUrl = $client->createAuthUrl();
                    $e = new \Exception('Token expirado. Reautentique.');
                    $e->authUrl = $authUrl;
                    // $e->code = 401;
                    throw $e;
                }
            }
            return $client;
        }


        // Sem token: expõe URL de autenticação para o frontend abrir
        $authUrl = $client->createAuthUrl();
        $e = new \Exception('Autenticação necessária. Abra o link para autorizar.');
        $e->authUrl = $authUrl;
        // $e->code = 401;
        throw $e;
    }


    /**
     * @param string $spreadsheetId ID da planilha
     * @param string $range Ex.: 'A:Z' ou 'Página1!A1:Z'
     */
    public function lerPlanilha(string $spreadsheetId, string $range = 'A:Z'): array
    {
        $client = $this->getClient();
        $service = new Sheets($client);
        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();


        // Normaliza: se vier vazio, devolve array vazio com mensagem
        if (!$values) {
            return ['dados' => []];
        }
        return ['dados' => $values];
    }
}

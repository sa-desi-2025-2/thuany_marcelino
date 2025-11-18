<?php
namespace Classes;


// require_once "Conexao.php";
use Google\Client;
use Google\Service\Sheets;
use Classes\Conexao;

class Planilha
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
    public function atualizarPlanilha()
    {
        $db = new Conexao();
        $leitorPlanilha = new Planilha();
        $idPlanilha = '19FPbSB4WxrAdRmdG_Xgc7MY5g6BvvAzI6Lwki7bUlEM';
        $dadosPlanilha = $leitorPlanilha->lerPlanilha($idPlanilha);

        $linhasDeDados = $dadosPlanilha['dados'];
        foreach ($linhasDeDados as $i => $linhaAtual) {
            // IGNORA a primeira linha (cabeçalho da planilha)
            if ($i == 0) {
                continue;
            }

            // Verifica se a linha tem pelo menos a coluna EWO
            // Se a linha tiver menos de 3 colunas, é uma linha em branco ou mal formatada.
            if (count($linhaAtual) < 3) {
                continue;
            }

            // IGNORA a linha se o campo EWO [2] ou SETOR [7] estiver vazio
            if (empty($linhaAtual[2]) || empty($linhaAtual[7])) {
                continue;
            }
            $linha = new Linha();
            $maquina = new Maquina();
            $ewo = new Ewo();

            $linha->nome_linha = trim($linhaAtual[6]);

            $maquina->id_linha = $linha->selecionarOuInserir($db);

            $maquina->nome_maquina = trim($linhaAtual[4]);
            $ewo->id_maquina = $maquina->selecionarOuInserir($db);

            $ewo->numero_ewo = $linhaAtual[2];
            $ewo->link_documento = $linhaAtual[3];
            $ewo->inserirEwo($db);

        }
    }
}

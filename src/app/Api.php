<?php


namespace Citadelle\Salesforce\app;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Api
 * @package App\Citadelle
 */
class Api
{
    /**
     * @var string
     */
    protected $url = null;

    /**
     * @var string
     */
    protected $token;


    /**
     * Api constructor.
     */
    public function __construct()
    {
        $this->token = $this->geAccessToken();
        $this->url = config('citadelle.salesforce.api.url');
    }

    protected function geAccessToken()
    {
        $client = new Client([
                'base_uri' => config('citadelle.salesforce.url_authorize')
            ]
        );

        $headers = [
            'query' => [
                'grant_type' => 'password',
                'client_id' => config('citadelle.salesforce.api.client_id'),
                'client_secret' => config('citadelle.salesforce.api.client_secret'),
                'username' => config('citadelle.salesforce.api.username'),
                'password' => config('citadelle.salesforce.api.password'),
            ],
            'headers' => [
                'Accept' => 'application/json'
            ]
        ];

        try {
            $response = $client->post(config('citadelle.salesforce.api.url_authorize'), $headers);

            if ($response->getStatusCode() != 200 or empty($response->getBody()->getContents())) {
                throw new SalesforceException("Impossible de récupèrer le token (" . $response->getStatusCode() . ")");
            }

        } catch (RequestException $exception) {
            throw new SalesforceException("Api::geAccessToken : " . $exception->getMessage());
        }

        return 'Bearer '.json_decode($response->getBody(), true)['access_token'];
    }


    /**
     * @param string $ressource_path
     * @return array
     * @throws SalesforceException
     */
    public function get(string $ressource_path): array
    {
        $client = new Client([
                'base_uri' => $this->url
            ]
        );

        $headers = [
            'headers' => [
                'Authorization' => $this->token,
            ]
        ];

        try {
            $response = $client->get($ressource_path, $headers);

            if ($response->getStatusCode() != 200 or empty($response->getBody()->getContents())) {
                throw new SalesforceException("Api::get : code http error (" . $response->getStatusCode() . ") ou body vide : " . $ressource_path);
            }

            return json_decode($response->getBody(), true);

        } catch (RequestException $exception) {
            /*$errors['request'] = Psr7\Message::toString($e->getRequest());
            if ($e->hasResponse()) {
                $errors['response'] = Psr7\Message::toString($e->getResponse());
            }*/

            throw new SalesforceException("Api::get : " . $exception->getMessage());
        }
    }

    /**
     * @param string $ressource_path
     * @param array $params
     * @return array
     * @throws SalesforceException|GuzzleException
     */
    public function post(string $ressource_path, array $params): array
    {
        $client = new Client(['base_uri' => $this->url]);
        $headers = [
            'headers' => [
                'Authorization' => $this->token,
            ],
            'json' => $params
        ];

        try {

            $response = $client->request('POST', $ressource_path, $headers);

            return json_decode($response->getBody(), true);

        } catch (RequestException $exception) {

            throw new SalesforceException("Api::post : " . $exception->getMessage() . ' '.print_r($params,true));
        }
    }
}

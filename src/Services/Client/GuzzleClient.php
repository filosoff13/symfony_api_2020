<?php


namespace App\Services\Client;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class GuzzleClient implements ClientInterface
{

    public $client;

    /**
     * GuzzleClient constructor.
     * @param string $endpoint
     * @param string $appId
     * @param string $appKey
     */
    public function __construct(string $endpoint, string $appId, string $appKey)
    {
        $this->client = new Client([
            'base_uri' => $endpoint,
            'headers' => [
                'Accept' => 'application/json',
                'app_id' => $appId,
                'app_key' => $appKey,
            ]
        ]);
    }

    /**
     * @param string $url
     * @return array
     * @throws ClientException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $url)
    {
        try {
            return json_decode($this->client->get($url)->getBody()->getContents());
        } catch (RequestException $e) {
            throw new ClientException($e->getMessage(), $e->getCode());
        }
    }
}
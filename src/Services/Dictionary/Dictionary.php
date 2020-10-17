<?php


namespace App\Services\Dictionary;

use App\Services\Client\ClientInterface;
use App\Services\Client\ClientException;

class Dictionary
{
    /**
     * @var \App\Services\Client\ClientInterface
     */
    public $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $lang
     * @param string $word
     * @return array
     */
    public function entries(string $lang = 'en-gb', string $word) : array
    {
        try {
            $body = $this->client->get(sprintf('%s/%s',
                $lang, $word
            ));
        } catch (ClientException $e) {

        }

        $pronunciation = $body->results[0]->lexicalEntries[0]->entries[0]->pronunciations[0]->audioFile;
        $definition = $body->results[0]->lexicalEntries[0]->entries[0]->senses[0]->definitions;

        return [
            'pronunciation' => $pronunciation,
            'definition' => $definition
        ];
    }
}
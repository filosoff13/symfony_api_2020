<?php
namespace App\Services\Client;

interface ClientInterface
{
    /**
     * @param string $url
     * @return mixed
     * @throws ClientException
     */
    public function get(string $url);
}

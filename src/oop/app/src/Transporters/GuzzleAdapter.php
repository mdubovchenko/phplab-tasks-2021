<?php

namespace src\oop\app\src\Transporters;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class GuzzleAdapter implements TransportInterface
{
    /**
     * @param string $url
     * @return string
     * @throws GuzzleException
     */
    public function getContent(string $url): string
    {
        $client = new Client(['base_uri' => $url]);

        return $client->request('GET', $url)->getBody();
    }
}

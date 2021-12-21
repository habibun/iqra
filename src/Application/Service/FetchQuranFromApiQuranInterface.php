<?php

namespace App\Application\Service;

use App\Domain\Service\FetchQuranInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FetchQuranFromApiQuranInterface implements FetchQuranInterface
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function fetch()
    {
        $response = $this->client->request(
            'GET',
            'http://api.alquran.cloud/v1/quran/en.asad'
        );

        $statusCode = $response->getStatusCode();
        if (200 !== $statusCode) {
            throw new \Exception('Status code is not valid');
        }

        $contentType = $response->getHeaders()['content-type'][0];

        if ('application/json' !== $contentType) {
            throw new \Exception('Content type is not valid');
        }

        return $response->toArray(true);
    }
}

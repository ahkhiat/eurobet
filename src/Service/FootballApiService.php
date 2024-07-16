<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class FootballApiService
{
    private $client;
    private $apiKey;

    public function __construct(HttpClientInterface $client, string $apiKey)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }

    public function fetchData(string $endpoint, array $parameters = [])
    {
        $response = $this->client->request(
            'GET',
            'https://v3.football.api-sports.io/' . $endpoint,
            [
                'headers' => [
                    'x-rapidapi-key' => $this->apiKey,
                ],
                'query' => $parameters,
            ]
        );

        return $response->toArray();
    }
}

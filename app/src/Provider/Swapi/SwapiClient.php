<?php

namespace App\Provider\Swapi;

use Symfony\Contracts\HttpClient\HttpClientInterface;

abstract class SwapiClient
{
    protected HttpClientInterface $client;
    protected String $apiUrl;

    public function __construct(HttpClientInterface $client, string $apiUrl)
    {
        $this->client = $client;
        $this->apiUrl = $apiUrl;
    }
} 


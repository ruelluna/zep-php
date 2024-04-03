<?php

namespace RuelLuna\ZepPhp;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ZepApiClient
{
    private $baseUrl;

    private $apiKey;

    private $httpClient;

    public function __construct($baseUrl, $apiKey)
    {
        $this->baseUrl = $baseUrl;
        $this->apiKey = $apiKey;
        $this->httpClient = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Authorization' => 'Bearer '.$this->apiKey,
                'Accept' => 'application/json',
            ],
        ]);
    }

    public function makeRequest($method, $uri, $data = [])
    {
        try {
            $options = [];
            if (! empty($data)) {
                $options['json'] = $data;
            }

            $response = $this->httpClient->request($method, $uri, $options);

            return json_decode($response->getBody()->getContents(), true);

        } catch (GuzzleException $e) {
            // Handle Guzzle exceptions here. You could log them or return a custom error message.
            return ['error' => $e->getMessage()];
        }
    }
}

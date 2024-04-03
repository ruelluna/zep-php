<?php

namespace RuelLuna\ZepPhp;

use Exception;

class Session
{
    private static $instance = null;

    private $apiClient;

    private function __construct($apiKey = null, $baseUrl = null)
    {
        $apiKey = $apiKey ?: getenv('ZEP_API_KEY');
        $baseUrl = $baseUrl ?: getenv('ZEP_BASE_URL');

        if (! $apiKey) {
            throw new Exception('API key is not provided or set in environment variables.');
        }

        if (! $baseUrl) {
            throw new Exception('Base URL is not provided or set in environment variables.');
        }

        $this->apiClient = new ZepApiClient($baseUrl, $apiKey);
    }

    public static function make($apiKey = null, $baseUrl = null)
    {
        if (self::$instance === null) {
            self::$instance = new self($apiKey, $baseUrl);
        }

        return self::$instance;
    }

    public static function getAll()
    {
        return self::make()
            ->apiClient
            ->makeRequest('GET', '/api/v1/sessions');
    }

    public static function getSession($sessionId)
    {
        return self::make()
            ->apiClient
            ->makeRequest('GET', "/api/v1/sessions/{$sessionId}");
    }

    private function __clone()
    {
    }

    public function __wakeup()
    {
        throw new Exception('Cannot unserialize a singleton.');
    }
}

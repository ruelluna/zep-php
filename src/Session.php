<?php

namespace RuelLuna\ZepPhp;

use Exception;

class Session
{
    private static $instance = null;

    private $apiClient;

    private function __construct()
    {
        $apiKey = getenv('ZEP_API_KEY');
        $baseUrl = getenv('ZEP_BASE_URL');

        if (! $apiKey) {
            throw new Exception('ZEP_API_KEY environment variable is not set.');
        }

        if (! $baseUrl) {
            throw new Exception('ZEP_BASE_URL environment variable is not set.');
        }

        $this->apiClient = new ZepApiClient($baseUrl, $apiKey);
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function getAll()
    {
        return self::getInstance()
            ->apiClient
            ->makeRequest('GET', '/api/v1/sessions');
    }

    public static function getSession($sessionId)
    {
        return self::getInstance()
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

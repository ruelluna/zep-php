<?php

namespace RuelLuna\ZepPhp;

use Exception;

class Message
{
    /**
     * @var null
     */
    private static $instance = null;

    /**
     * @var ZepApiClient
     */
    private $apiClient;

    /**
     * @throws Exception
     */
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

    /**
     * @return self|null
     */
    public static function make($apiKey = null, $baseUrl = null)
    {
        if (self::$instance === null) {
            self::$instance = new self($apiKey, $baseUrl);
        }

        return self::$instance;
    }

    /**
     * Retrieves all messages for a specific session.
     *
     * @return array|mixed
     */
    public static function getAll($sessionId)
    {
        return self::make()
            ->apiClient
            ->makeRequest('GET', '/api/v1/sessions/'.$sessionId.'/messages');
    }

    /**
     * Retrieves a specific message
     *
     * @return array|mixed
     */
    public static function getMessage($sessionId, $messageId)
    {
        return self::make()
            ->apiClient
            ->makeRequest('GET', "/api/v1/sessions/{$sessionId}/messages/{$messageId}");
    }

    /**
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * @return mixed
     *
     * @throws Exception
     */
    public function __wakeup()
    {
        throw new Exception('Cannot unserialize a singleton.');
    }
}

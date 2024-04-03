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

    /**
     * @return self|null
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
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
        return self::getInstance()
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
        return self::getInstance()
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

<?php

namespace Vdhicts\UptimeRobot\Client;

use Vdhicts\UptimeRobot\Client\Exceptions;

class Configuration
{
    /**
     * Holds the api key.
     * @var string
     */
    private $apiKey = '';
    /**
     * Holds the api url.
     * @var string
     */
    private $apiUrl = 'https://api.uptimerobot.com/v2/';

    /**
     * Configuration constructor.
     * @param string $apiUrl
     * @param string $apiKey
     */
    public function __construct(string $apiKey, string $apiUrl = null)
    {
        $this->setApiKey($apiKey);
        $this->setApiUrl($apiUrl);
    }

    /**
     * Returns the api key.
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * Stores the api key.
     * @param string $apiKey
     */
    public function setApiKey(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Returns the api url
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    /**
     * Stores the api url.
     * @param string|null $apiUrl
     * @throws Exceptions\InvalidApiUrlException
     */
    public function setApiUrl(string $apiUrl = null)
    {
        if (is_null($apiUrl)) {
            return;
        }

        if (! filter_var($apiUrl, FILTER_VALIDATE_URL)) {
            throw new Exceptions\InvalidApiUrlException($apiUrl);
        }

        $this->apiUrl = $apiUrl;
    }
}

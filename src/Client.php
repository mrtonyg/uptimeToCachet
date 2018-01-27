<?php

namespace Vdhicts\UptimeRobot\Client;

use Vdhicts\UptimeRobot\Client\Exceptions;

class Client
{
    const ALLOWED_METHODS = [
        'GET',
        'POST'
    ];
    const ALLOWED_FORMATS = [
        'xml',
        'json'
    ];

    /**
     * Holds the API configuration.
     * @var Configuration
     */
    private $configuration;

    /**
     * Holds the curl handler.
     * @var resource
     */
    private $curlHandler;

    /**
     * Client constructor.
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $this->setConfiguration($configuration);

        $this->initCurl();
    }

    /**
     * Returns the API configuration.
     * @return Configuration
     */
    private function getConfiguration(): Configuration
    {
        return $this->configuration;
    }

    /**
     * Stores the API configuration
     * @param Configuration $configuration
     */
    private function setConfiguration(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * Returns the url for the API request.
     * @param string $endpoint
     * @return string
     * @throws Exceptions\InvalidApiEndpointException
     * @throws Exceptions\InvalidApiUrlException
     */
    private function getUrl(string $endpoint): string
    {
        $apiBaseUrl = $this->getConfiguration()->getApiUrl();
        if (! filter_var($apiBaseUrl, FILTER_VALIDATE_URL)) {
            throw new Exceptions\InvalidApiUrlException();
        }

        if (strlen(trim($endpoint)) === 0) {
            throw new Exceptions\InvalidApiEndpointException();
        }

        return sprintf('%s%s', $apiBaseUrl, $endpoint);
    }

    /**
     * Returns the method for the API request. At this moment it's always a POST request, but that might change some
     * time so it's not restricted programmatically.
     * @param string $method
     * @return string
     * @throws Exceptions\InvalidApiMethodException
     */
    private function getMethod(string $method): string
    {
        // Always use the method in uppercase
        $method = strtoupper($method);

        // The method must be supported
        if (! in_array($method, self::ALLOWED_METHODS)) {
            throw new Exceptions\InvalidApiMethodException($method, self::ALLOWED_METHODS);
        }

        return $method;
    }

    /**
     * Returns the format for the API response.
     * @param string $format
     * @return string
     * @throws Exceptions\InvalidApiFormatException
     */
    private function getFormat(string $format): string
    {
        // Always use the format in lowercase
        $format = strtolower($format);

        // The method must be supported
        if (! in_array($format, self::ALLOWED_FORMATS)) {
            throw new Exceptions\InvalidApiFormatException($format, self::ALLOWED_FORMATS);
        }

        return $format;
    }

    /**
     * Returns the body for the API request.
     * @param string $format
     * @param array $parameters
     * @return string
     * @throws Exceptions\InvalidApiKeyException
     */
    private function getBody(string $format = 'json', array $parameters = []): string
    {
        $apiKey = $this->getConfiguration()->getApiKey();
        if (strlen(trim($apiKey)) === 0) {
            throw new Exceptions\InvalidApiKeyException();
        }

        $bodyValues = array_merge(
            $parameters,
            [
                'api_key' => $this->getConfiguration()->getApiKey(),
                'format'  => $this->getFormat($format)
            ]
        );

        return http_build_query($bodyValues);
    }

    /**
     * Returns the headers for the API request.
     * @return array
     */
    private function getHeaders(): array
    {
        return [
            'cache-control: no-cache',
            'content-type: application/x-www-form-urlencoded'
        ];
    }

    /**
     * Initializes curl.
     * @throws Exceptions\CurlNotSupportedException
     */
    private function initCurl()
    {
        // Start a new cURL session
        $this->curlHandler = curl_init();

        // When a cURL session can't be initialized, there's no way to perform a API request.
        if (! $this->curlHandler) {
            throw new Exceptions\CurlNotSupportedException();
        }

        // Set the cURL options
        curl_setopt($this->curlHandler, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($this->curlHandler, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($this->curlHandler, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->curlHandler, CURLOPT_HEADER, 0);
    }

    /**
     * Performs an API request.
     * @param string $endpoint
     * @param array $parameters
     * @param string $format
     * @param string $method
     * @return string
     * @throws Exceptions\FailedRequestException
     */
    public function perform(string $endpoint, array $parameters = [], string $format = 'json', string $method = 'POST'): string
    {
        curl_setopt($this->curlHandler, CURLOPT_URL, $this->getUrl($endpoint));
        curl_setopt($this->curlHandler, CURLOPT_CUSTOMREQUEST , $this->getMethod($method));
        curl_setopt($this->curlHandler, CURLOPT_POSTFIELDS , $this->getBody($format, $parameters));
        curl_setopt($this->curlHandler, CURLOPT_HTTPHEADER , $this->getHeaders());

        // Execute the cURL session
        $result = curl_exec($this->curlHandler);

        // When no results, see the request as failed
        if (! $result) {
            throw new Exceptions\FailedRequestException(curl_error($this->curlHandler));
        }

        // The API call is successful return the parsed results
        return $result;
    }
}

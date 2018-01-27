<?php

namespace Vdhicts\UptimeRobot\Client\Exceptions;

use Throwable;
use Vdhicts\UptimeRobot\Client\UptimeRobotClientException;

class FailedRequestException extends UptimeRobotClientException
{
    /**
     * RequestFailedException constructor.
     * @param string $curlError
     * @param Throwable|null $previous
     */
    public function __construct($curlError = '', Throwable $previous = null)
    {
        parent::__construct(
            sprintf('Curl error occurred: %s', $curlError),
            0,
            $previous
        );
    }
}

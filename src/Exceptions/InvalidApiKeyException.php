<?php

namespace Vdhicts\UptimeRobot\Client\Exceptions;

use Throwable;
use Vdhicts\UptimeRobot\Client\UptimeRobotClientException;

class InvalidApiKeyException extends UptimeRobotClientException
{
    /**
     * InvalidApiKeyException constructor.
     * @param Throwable|null $previous
     */
    public function __construct(Throwable $previous = null)
    {
        parent::__construct(
            'The API key must be provided',
            0,
            $previous
        );
    }
}

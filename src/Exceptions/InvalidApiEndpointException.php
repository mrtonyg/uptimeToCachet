<?php

namespace Vdhicts\UptimeRobot\Client\Exceptions;

use Throwable;
use Vdhicts\UptimeRobot\Client\UptimeRobotClientException;

class InvalidApiEndpointException extends UptimeRobotClientException
{
    /**
     * InvalidApiEndpointException constructor.
     * @param Throwable|null $previous
     */
    public function __construct(Throwable $previous = null)
    {
        parent::__construct(
            'The request endpoint must be provided',
            0,
            $previous
        );
    }
}

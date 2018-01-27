<?php

namespace Vdhicts\UptimeRobot\Client\Exceptions;

use Throwable;
use Vdhicts\UptimeRobot\Client\UptimeRobotClientException;

class InvalidApiUrlException extends UptimeRobotClientException
{
    /**
     * InvalidApiUrlException constructor.
     * @param string $invalidUrl
     * @param Throwable|null $previous
     */
    public function __construct($invalidUrl = '', Throwable $previous = null)
    {
        parent::__construct(
            sprintf('The API url must be a valid url, provided "%s"', $invalidUrl),
            0,
            $previous
        );
    }
}

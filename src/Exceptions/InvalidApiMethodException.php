<?php

namespace Vdhicts\UptimeRobot\Client\Exceptions;

use Throwable;
use Vdhicts\UptimeRobot\Client\UptimeRobotClientException;

class InvalidApiMethodException extends UptimeRobotClientException
{
    /**
     * InvalidApiMethodException constructor.
     * @param string $method
     * @param array $allowedMethods
     * @param Throwable|null $previous
     */
    public function __construct(string $method, array $allowedMethods, Throwable $previous = null)
    {
        parent::__construct(
            sprintf('The `%s` method is not allowed, please use `%s`', $method, implode(', ', $allowedMethods)),
            0,
            $previous
        );
    }
}

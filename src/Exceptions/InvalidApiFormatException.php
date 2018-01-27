<?php

namespace Vdhicts\UptimeRobot\Client\Exceptions;

use Throwable;
use Vdhicts\UptimeRobot\Client\UptimeRobotClientException;

class InvalidApiFormatException extends UptimeRobotClientException
{
    /**
     * InvalidApiFormatException constructor.
     * @param string $format
     * @param array $allowedFormats
     * @param Throwable|null $previous
     */
    public function __construct(string $format, array $allowedFormats, Throwable $previous = null)
    {
        parent::__construct(
            sprintf('The `%s` format is not allowed, please use `%s`', $format, implode(', ', $allowedFormats)),
            0,
            $previous
        );
    }
}

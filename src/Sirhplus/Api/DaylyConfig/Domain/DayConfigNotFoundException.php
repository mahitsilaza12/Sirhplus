<?php

namespace Sirhplus\Api\DaylyConfig\Domain;

use JetBrains\PhpStorm\Pure;

/**
 * class DayConfigNotFound
 */
final class DayConfigNotFoundException extends \RuntimeException
{
    private const MESSAGE = 'day COnfig not found.';
    private const CODE = 400;

    /**
     * @param [type] $message
     * @param [type] $code
     * @param Throwable|null $previous
     */
    #[Pure] public function __construct(string $message = self::MESSAGE, int $code = self::CODE, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
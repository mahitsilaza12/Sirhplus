<?php

namespace Sirhplus\Shared\Domain\Exception;

use JetBrains\PhpStorm\Pure;

/**
 * InvalidSexeValueException
 */
final class InvalidSexeValueException extends \UnexpectedValueException
{
    private const MESSAGE = 'Invalid value ';
    private const HTTP_CODE = 400;

    #[Pure] public function __construct(string $message = self::MESSAGE, int $code = self::HTTP_CODE, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
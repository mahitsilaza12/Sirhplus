<?php

namespace Sirhplus\Shared\Domain\Exception;

use JetBrains\PhpStorm\Pure;

class InvalidTokenException extends \Exception
{
    private const MESSAGE = 'Invalid token';

    #[Pure] public function __construct(string $message = self::MESSAGE, int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

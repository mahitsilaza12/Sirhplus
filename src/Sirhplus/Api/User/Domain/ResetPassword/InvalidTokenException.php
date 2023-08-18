<?php

namespace Sirhplus\Api\User\Domain\ResetPassword;

use JetBrains\PhpStorm\Pure;

final class InvalidTokenException extends \InvalidArgumentException
{
    private const MESSAGE = 'Invalid token';

    #[Pure] public function __construct(string $message = self::MESSAGE, int $code = 400, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

<?php

namespace Sirhplus\Shared\Domain\Exception;

use JetBrains\PhpStorm\Pure;

/**
 * class UnauthorizedException
 */
final class UnauthorizedException extends \RuntimeException
{
    private const MESSAGE = 'Unauthorized resource.'; // TODO a modifier
    private const CODE = 401;

    #[Pure] public function __construct(string $message = self::MESSAGE, int $code = self::CODE, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

<?php

namespace Sirhplus\Shared\Domain\Exception;

use JetBrains\PhpStorm\Pure;

final class valueErrorNameException extends \UnexpectedValueException
{
    private const MESSAGE = ' name alredy exist';
    private const HTTP_CODE = 400;

    #[Pure] public function __construct(string $message = self::MESSAGE, int $code = self::HTTP_CODE, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
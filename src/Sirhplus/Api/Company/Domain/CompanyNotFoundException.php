<?php

namespace Sirhplus\Api\Company\Domain;

use JetBrains\PhpStorm\Pure;

/**
 * class CompanyNotFoundException
 */
final class CompanyNotFoundException extends \RuntimeException
{
    private const MESSAGE = 'Company not found.';
    private const CODE = 400;

    #[Pure] public function __construct(string $message = self::MESSAGE, int $code = self::CODE, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

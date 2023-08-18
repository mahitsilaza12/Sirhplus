<?php

namespace Sirhplus\Api\Salary\Domain;

use JetBrains\PhpStorm\Pure;


final class SalaryNotFoundException extends \RuntimeException
{
    private const MESSAGE = 'Salarie not found.';
    private const CODE = 400;

    #[Pure] public function __construct(string $message = self::MESSAGE, int $code = self::CODE, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
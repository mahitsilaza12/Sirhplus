<?php

namespace Sirhplus\Api\TypeAbsence\Domain;

use JetBrains\PhpStorm\Pure;

/**
 * class TypeAbsenceNotFoundException
 */
final class TypeAbsenceNotFoundException extends \RuntimeException
{

    private const MESSAGE = 'Type Absence not found.';
    private const CODE = 400;

    #[Pure] public function __construct(string $message = self::MESSAGE, int $code = self::CODE, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
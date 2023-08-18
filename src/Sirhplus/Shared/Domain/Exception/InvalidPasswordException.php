<?php

namespace Sirhplus\Shared\Domain\Exception;

/**
 * class InvalidPasswordException
 */
final class InvalidPasswordException extends \InvalidArgumentException
{
    private const MESSAGE = 'Mot de passe incorrect';
    private const HTTP_CODE = 400;

    /**
     * @param string $message
     * @param int $code
     */
    public function __construct(string $message = self::MESSAGE, int $code = self::HTTP_CODE)
    {
        parent::__construct($message, $code);
    }
}

<?php

namespace Sirhplus\Shared\Domain\Exception;

/**
 * class InvalidValueException
 */
final class InvalidValueException extends DomainError
{
    protected $message = '';

    public function __construct(string $message = '')
    {
        parent::__construct();
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function errorCode(): string
    {
        return 'invalid_value';
    }

    /**
     * @return string
     */
    protected function errorMessage(): string
    {
        return $this->message ?? 'Invalid request value.';
    }
}

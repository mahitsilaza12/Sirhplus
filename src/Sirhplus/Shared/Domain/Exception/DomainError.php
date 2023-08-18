<?php

namespace Sirhplus\Shared\Domain\Exception;

use DomainException;

/**
 * class DomainError
 */
abstract class DomainError extends DomainException
{
    /**
     * DomainError constructor
     */
    public function __construct()
    {
        parent::__construct($this->errorMessage());
    }

    /**
     * @return string
     */
    abstract public function errorCode(): string;

    /**
     * @return string
     */
    abstract protected function errorMessage(): string;
}

<?php

namespace Sirhplus\Api\Functions\Domain;

use Sirhplus\Shared\Domain\Exception\DomainError;

final class FunctionNotFound extends DomainError
{
    public function __construct(private readonly string $functionId)
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'function_not_found';
    }

    protected function errorMessage(): string
    {
        return sprintf('Function <%s> has not been found', $this->functionId);
    }
}

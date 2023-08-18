<?php

namespace Sirhplus\Api\User\Domain;

use Sirhplus\Shared\Domain\Exception\DomainError;

/**
 * class UsersSalaryNotFound
 */
final class UsersSalaryNotFound extends DomainError
{
    public function __construct(private readonly string $companyUuid)
    {
        parent::__construct();
    }

    /**
     * @return string
     */
    public function errorCode(): string
    {
        return 'users_salary_not_found';
    }

    /**
     * @return string
     */
    protected function errorMessage(): string
    {
        return sprintf('Company users salary <%s> has not been found', $this->companyUuid);
    }
}

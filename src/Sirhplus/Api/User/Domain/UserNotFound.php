<?php

namespace Sirhplus\Api\User\Domain;

use Sirhplus\Shared\Domain\Exception\DomainError;

/**
 * class UserNotFound
 */
final class UserNotFound extends DomainError
{
    /**
     * @param string $userId
     */
    public function __construct(private readonly string $userId)
    {
        parent::__construct();
    }

    /**
     * @return string
     */
    public function errorCode(): string
    {
        return 'user_not_found';
    }

    /**
     * @return string
     */
    protected function errorMessage(): string
    {
        return sprintf('User <%s> has not been found', $this->userId);
    }
}

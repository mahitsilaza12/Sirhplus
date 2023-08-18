<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain;

use Sirhplus\Shared\Domain\Exception\DomainError;

/**
 * class TeamNotFound
 */
final class TeamNotFound extends DomainError
{
    /**
     * @param string $uuid
     */
    public function __construct(private readonly string $uuid)
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'team_not_found';
    }

    protected function errorMessage(): string
    {
        return sprintf('Team <%s> has not been found', $this->uuid);
    }
}

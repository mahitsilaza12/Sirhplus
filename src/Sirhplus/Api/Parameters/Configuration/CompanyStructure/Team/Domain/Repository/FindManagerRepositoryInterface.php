<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\Repository;

use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\TeamUuid;
use Sirhplus\Api\User\Domain\UserResultSet;

interface FindManagerRepositoryInterface
{
    /**
     * @param TeamUuid $uuid
     * @return UserResultSet|null
     */
    public function findTeamManagers(TeamUuid $uuid): ?UserResultSet;
}

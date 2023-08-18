<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\Repository;

interface AssignTeamManagerInterface
{
    /**
     * @param array $users
     * @return void
     */
    public function assign(array $users = []): void;
}

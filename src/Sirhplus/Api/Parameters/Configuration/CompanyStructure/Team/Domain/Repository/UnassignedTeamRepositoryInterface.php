<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\Repository;

use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\TeamNotFound;
use Symfony6\Entity\Salary;

interface UnassignedTeamRepositoryInterface
{
    /**
     * @param Salary $salary
     * @return void
     * @throws TeamNotFound
     */
    public function unassigned(Salary $salary): void;
}

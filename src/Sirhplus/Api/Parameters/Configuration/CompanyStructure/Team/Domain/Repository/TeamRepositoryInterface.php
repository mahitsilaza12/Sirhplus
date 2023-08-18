<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\Repository;

use Sirhplus\Api\Company\Domain\CompanyNotFoundException;
use Sirhplus\Api\Company\Domain\CompanyTeamResultSet;
use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\FindTeamResultSet;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\Model\CreateTeamModel;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\Model\EditTeamModel;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\TeamNotFound;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\TeamUuid;

/**
 * interface TeamRepositoryInterface
 */
interface TeamRepositoryInterface
{
    /**
     * @param CreateTeamModel $model
     * @return void
     */
    public function create(CreateTeamModel $model): void;

    /**
     * @param EditTeamModel $model
     * @return void
     * @throws TeamNotFound
     */
    public function edit(EditTeamModel $model): void;

    /**
     * @param TeamUuid $uuid
     * @return void
     * @throws TeamNotFound
     */
    public function remove(TeamUuid $uuid): void;

    /**
     * @param TeamUuid $uuid
     * @return FindTeamResultSet
     * @throws TeamNotFound
     */
    public function findByUuid(TeamUuid $uuid): FindTeamResultSet;

    /**
     * @param CompanyUuid $uuid
     * @return CompanyTeamResultSet
     * @throws CompanyNotFoundException
     */
    public function findTeamByCompanyUuid(CompanyUuid $uuid): CompanyTeamResultSet;
}

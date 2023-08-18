<?php

namespace Sirhplus\Api\Salary\Domain\Repository;

use Sirhplus\Api\Functions\Domain\FunctionUuid;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain\SiteUuid;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\TeamUuid;
use Sirhplus\Api\Salary\Domain\Model\AddSalaryModel;
use Sirhplus\Api\Salary\Domain\Model\EditSalaryModel;
use Sirhplus\Api\Salary\Domain\SalaryBySiteResultSet;
use Sirhplus\Api\Salary\Domain\SalaryNotFoundException;
use Sirhplus\Api\Salary\Domain\SalaryResultSet;
use Sirhplus\Api\Salary\Domain\SalaryUuid;
use Sirhplus\Api\Salary\Domain\ShowSalaryByIdResult;
use Sirhplus\Api\User\Domain\UserUuid;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Application\Select;
use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;
use Sirhplus\Shared\Domain\ValueObject\Uuid;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony6\Entity\Salary;

/**
 * interface SalaryRepositoryInterface
 */
interface SalaryRepositoryInterface
{
     /**
     * @param AddSalaryModel $model
     * @param UserInterface $user
     */
    public function add(AddSalaryModel $model, UserInterface $user): void;

     /**
     * @param Salary $salary
     * @return void
     */
    public function edit(Salary $salary,EditSalaryModel $model): void;

     /**
     * @param SalaryUuid $uuid
     * @return ShowSalaryByIdResult
     * @throws SalaryNotFoundException
     */
    public function findSalaryById(SalaryUuid $uuid): ShowSalaryByIdResult;

     /**
     * @param Select $select
     * @param Criteria $criteria
     * @return AbstractResultSet
     */
    public function getMatching(Select $select, Criteria $criteria): AbstractResultSet;

    /**
     * @param FunctionUuid $uuid
     * @param UserUuid|null $userUuid
     * @return void
     */
    public function unassigned(FunctionUuid $uuid, ?UserUuid $userUuid = null): void;

    /**
     * @param TeamUuid $teamUuid
     * @param UserUuid $userUuid
     * @return Salary
     */
    public function findSalaryByTeamUuid(TeamUuid $teamUuid, UserUuid $userUuid): Salary;

    /**
     * @param SalaryUuid $uuid
     * @param string $logo
     * @return void
     * @throws SalaryNotFoundException
     */
    public function updateLogo(SalaryUuid $uuid, string $logo): void;

    /**
     * @param Uuid $uuid
     * @param string $type
     * @return SalaryResultSet|null
     */
    public function findSalariesByType(Uuid $uuid, string $type): ?SalaryResultSet;
}

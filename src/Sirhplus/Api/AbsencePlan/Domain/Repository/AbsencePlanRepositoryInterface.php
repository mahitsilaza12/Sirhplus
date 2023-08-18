<?php

namespace Sirhplus\Api\AbsencePlan\Domain\Repository;

use Sirhplus\Api\AbsencePlan\Domain\AbsencePlanNotFoundException;
use Sirhplus\Api\AbsencePlan\Domain\AbsencePlanUuid;
use Sirhplus\Api\AbsencePlan\Domain\Model\AddAbsencePlanModel;
use Sirhplus\Api\AbsencePlan\Domain\Model\EditAbsencePlanModel;
use Sirhplus\Api\AbsencePlan\Domain\ShowAbsencePlanByIdResult;
use Sirhplus\Api\Company\Domain\CompanyAbsencePlanResultSet;
use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Application\Select;
use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;
use Symfony6\Entity\AbsencePlan;

/**
 * interface AbsencePlanRepositoryInterface
 */
interface AbsencePlanRepositoryInterface
{

    /**
     * @param AddAbsencePlanModel $model
     * @return void
     */
    public function add(AddAbsencePlanModel $model): void;

    /**
     * @param AbsencePlan $absencePlan
     * @param EditAbsencePlanModel $model
     * @return void
     */
    public function edit(AbsencePlan $absencePlan, EditAbsencePlanModel $model): void;

    /**
     * @param AbsencePlanUuid $uuid
     * @return ShowAbsencePlanByIdResult
     * @throws AbsencePlanNotFoundException
     */
    public function findAbsencePlanById(AbsencePlanUuid $uuid): ShowAbsencePlanByIdResult;

    /**
     * @param AbsencePlanUuid $uuid
     * @return void
     */
    public function remove(AbsencePlanUuid $uuid): void;

    /**
     * @param Select $select
     * @param Criteria $criteria
     * @return AbstractResultSet
     */
    public function getMatching(Select $select, Criteria $criteria): AbstractResultSet;
    
    /**
     * @param CompanyUuid $uuid
     * @return CompanyAbsencePlanResultSet
     */
    public function findAbsencePlanByCompanyUuid(CompanyUuid $uuid): CompanyAbsencePlanResultSet;

}
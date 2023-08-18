<?php

namespace Sirhplus\Api\TypeAbsence\Domain\Repository;

use Sirhplus\Api\AbsencePlan\Domain\AbsencePlanUuid;
use Sirhplus\Api\Company\Domain\CompanyTypeAbsenceResultSet;
use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\TypeAbsence\Domain\Model\AddTypeAbsenceModel;
use Sirhplus\Api\TypeAbsence\Domain\Model\EditTypeAbsenceByIdModel;
use Sirhplus\Api\TypeAbsence\Domain\Model\EditTypeAbsenceModel;
use Sirhplus\Api\TypeAbsence\Domain\ShowTypeAbsenceByIdResult;
use Sirhplus\Api\TypeAbsence\Domain\TypeAbsenceNotFoundException;
use Sirhplus\Api\TypeAbsence\Domain\TypeAbsenceUuid;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Application\Select;
use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;
use Symfony6\Entity\TypeAbsence;

/**
 * interface TypeAbsenceRepositoryInterface
 */
interface TypeAbsenceRepositoryInterface
{

    /**
     * @param AddTypeAbsenceModel $model
     * @return ShowTypeAbsenceByIdResult
     */
    public function add(AddTypeAbsenceModel $model): ShowTypeAbsenceByIdResult;

    /**
     * @param EditTypeAbsenceModel $model
     * @return void
     */
    public function edit(TypeAbsence $typeAbsence, EditTypeAbsenceModel $model): void;

    /**
     * @param TypeAbsence $typeAbsence
     * @param EditTypeAbsenceByIdModel $model
     * @return void
     */
    public function editById(TypeAbsence $typeAbsence, EditTypeAbsenceByIdModel $model): void;

    /**
     * @param TypeAbsenceUuid $id
     * @return ShowTypeAbsenceByIdResult
     */
    public function findTypeAbsenceById(TypeAbsenceUuid $uuid): ShowTypeAbsenceByIdResult;

    /**
     * @param TypeAbsenceUuid $uuid
     * @return ShowTypeAbsenceByIdResult
     */
    public function findTypeAbsenceByAbsencePlan(TypeAbsenceUuid $uuid): ShowTypeAbsenceByIdResult;
    /**
     * @param TypeAbsenceUuid $uuid
     * @return void
     * @throws TypeAbsenceNotFoundException
     */
    public function remove(TypeAbsenceUuid $uuid): void;

        /**
     * @param Select $select
     * @param Criteria $criteria
     * @return AbstractResultSet
     */
    public function getMatching(Select $select, Criteria $criteria): AbstractResultSet;

    /**
     * @param CompanyUuid $uuid
     * @return CompanyTypeAbsenceResultSet
     * @throws CompanyNotFoundException
     */
    public function findTypeByCompany(CompanyUuid $uuid): CompanyTypeAbsenceResultSet;
    
    /**
     * @param TypeAbsenceUuid $uuid
     * @param string $absencePlanId
     * @param string $entityClass
     * @return void
     */
    public function assignTypeAbsenceByAbsensePlan(TypeAbsenceUuid $uuid, string $absencePlanId, string $entityClass): void;
    
    /**
     * @param TypeAbsenceUuid $uuid
     * @param string $absencePlanId
     * @param string $entityClass
     * @return void
     */
    public function unassignTypeAbsenceByAbsensePlan(TypeAbsenceUuid $uuid, string $absencePlanId, string $entityClass): void;
  

}
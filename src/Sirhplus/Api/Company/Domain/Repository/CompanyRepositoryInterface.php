<?php

namespace Sirhplus\Api\Company\Domain\Repository;

use Sirhplus\Api\Company\Domain\CompanyNotFoundException;
use Sirhplus\Api\Company\Domain\CompanyResultSet;
use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\Company\Domain\Model\AddCompanyModel;
use Sirhplus\Api\Company\Domain\Model\CompanySubscriberModel;
use Sirhplus\Api\Company\Domain\Model\EditCompanyModel;
use Sirhplus\Api\Company\Domain\ShowCompanyByIdResultSet;
use Sirhplus\Api\User\Domain\UserUuid;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Application\Select;
use Symfony6\Entity\Company;

/**
 * interface CompanyRepositoryInterface
 */
interface CompanyRepositoryInterface
{
    /**
     * @param AddCompanyModel $model
     * @return ShowCompanyByIdResultSet
     */
    public function add(AddCompanyModel $model): ShowCompanyByIdResultSet;

    /**
     * @param Select $select
     * @param Criteria $criteria
     * @return CompanyResultSet
     */
    public function getMatching(Select $select, Criteria $criteria): CompanyResultSet;

    /**
     * @param Company $company
     * @param EditCompanyModel $model
     * @return void
     */
    public function edit(Company $company, EditCompanyModel $model): void;

    /**
     * @param CompanyUuid $id
     * @return ShowCompanyByIdResultSet
     * @throws CompanyNotFoundException
     */
    public function findCompanyById(CompanyUuid $id): ShowCompanyByIdResultSet;

    /**
     * @param Company $company
     * @param CompanySubscriberModel $model
     * @return void
     */
    public function subscriber(Company $company, CompanySubscriberModel $model): void;

    /**
     * @param CompanyUuid $companyUuid
     * @param UserUuid $userUuid
     * @return void
     * @throws CompanyNotFoundException
     */
    public function unassignedProperty(CompanyUuid $companyUuid, UserUuid $userUuid): void;

    /**
     * @param CompanyUuid $companyUuid
     * @param string $logo
     * @return void
     * @throws CompanyNotFoundException
     */
    public function updateLogo(CompanyUuid $companyUuid, string $logo): void;
}

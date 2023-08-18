<?php

namespace Sirhplus\Api\Company\Domain\Repository;

use Sirhplus\Api\Company\Domain\CompanyNotFoundException;
use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\User\Domain\UserNotFound;
use Sirhplus\Api\User\Domain\UserUuid;

/**
 * interface AssignRepositoryInterface
 */
interface AssignRepositoryInterface
{
    /**
     * @param CompanyUuid $companyUuid
     * @param UserUuid $userUuid
     * @return void
     * @throws CompanyNotFoundException
     * @throws UserNotFound
     */
    public function assignPropertyToCompany(CompanyUuid $companyUuid, UserUuid $userUuid): void;
}

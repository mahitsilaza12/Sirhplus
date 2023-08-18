<?php

namespace Sirhplus\Api\User\Domain\Repository;

use Sirhplus\Api\Company\Domain\CompanyUuid;

/**
 * interface AssignRepositoryInterface
 */
interface AssignRepositoryInterface
{
    /**
     * @param CompanyUuid $uuid
     * @param array|null $users
     * @return void
     */
    public function assignAdminToCompany(CompanyUuid $uuid, array|null $users = []): void;
}

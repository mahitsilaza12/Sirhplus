<?php

namespace Sirhplus\Api\Functions\Domain\Repository;

use Sirhplus\Api\Company\Domain\CompanyFunctionResultSet;
use Sirhplus\Api\Company\Domain\CompanyUuid;

/**
 * interface FindFunctionByCompanyRepositoryInterface
 */
interface FindFunctionByCompanyRepositoryInterface
{
    /**
     * @param CompanyUuid $uuid
     * @return CompanyFunctionResultSet
     */
    public function findFunctionByCompany(CompanyUuid $uuid): CompanyFunctionResultSet;
}

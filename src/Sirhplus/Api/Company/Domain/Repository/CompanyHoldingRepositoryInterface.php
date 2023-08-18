<?php

namespace Sirhplus\Api\Company\Domain\Repository;

use Sirhplus\Api\Company\Domain\CompanyHoldingResultSet;
use Sirhplus\Api\Company\Domain\CompanyUuid;

/**
 * interface CompanyHoldingRepositoryInterface
 */
interface CompanyHoldingRepositoryInterface
{
    /**
     * @param CompanyUuid $uuid
     * @return CompanyHoldingResultSet
     */
    public function getHoldingAndFilialByCompanyUuid(CompanyUuid $uuid): CompanyHoldingResultSet;
}

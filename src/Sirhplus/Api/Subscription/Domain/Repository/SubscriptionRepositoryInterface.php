<?php

namespace Sirhplus\Api\Subscription\Domain\Repository;

use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\Subscription\Domain\SubscriptionResultSet;

/**
 * interface SubscriptionRepositoryInterface
 */
interface SubscriptionRepositoryInterface
{
    /**
     * @return SubscriptionResultSet
     */
    public function fetch(): SubscriptionResultSet;
}

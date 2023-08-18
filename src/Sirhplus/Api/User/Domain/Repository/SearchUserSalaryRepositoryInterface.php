<?php

namespace Sirhplus\Api\User\Domain\Repository;

use Sirhplus\Shared\Domain\Query\QueryParams;
use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;

/**
 * interface SearchSalaryRepositoryInterface
 */
interface SearchUserSalaryRepositoryInterface
{
    public function search(QueryParams $query): AbstractResultSet;
}

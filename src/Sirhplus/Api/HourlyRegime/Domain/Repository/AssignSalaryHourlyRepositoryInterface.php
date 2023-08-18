<?php

namespace Sirhplus\Api\HourlyRegime\Domain\Repository;

use Sirhplus\Api\HourlyRegime\Domain\HourlyRegimeUuid;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Application\Select;
use Sirhplus\Shared\Domain\Query\ObjectQuery;
use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;

/**
 * interface AssignSalaryHourlyRepositoryInterface
 */
interface AssignSalaryHourlyRepositoryInterface
{
    /**
     * @param HourlyRegimeUuid $uuid
     * @param array $users
     * @param string $entityClass
     * @return void
     */
    public function assignSalaryHourlyRegime(HourlyRegimeUuid $uuid, array $users, string $entityClass): void;

    /**
     * @param HourlyRegimeUuid $uuid
     * @param array $users
     * @param string $entityClass
     * @return void
     */
    public function UnAssignSalaryHourlyRegime(HourlyRegimeUuid $uuid, array $users, string $entityClass): void;

    /**
     * @param Select $select
     * @param Criteria $criteria
     * @return ObjectQuery
     */
    public function getMappingAssign(Select $select, Criteria $criteria): ObjectQuery;

}
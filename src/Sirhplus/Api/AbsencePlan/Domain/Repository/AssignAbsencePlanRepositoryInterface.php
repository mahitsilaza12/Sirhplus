<?php

namespace Sirhplus\Api\AbsencePlan\Domain\Repository;

use Sirhplus\Api\AbsencePlan\Domain\AbsencePlanUuid;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Application\Select;
use Sirhplus\Shared\Domain\Query\ObjectQuery;
use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;

interface AssignAbsencePlanRepositoryInterface
{
  /**
   * @param AbsencePlanUuid $uuid
   * @param array $users
   * @param string $entityClass
   * @return void
   */
  public function assignSalaryAbsencePlan(AbsencePlanUuid $uuid, array $users, string $entityClass): void;
  
  /**
   * @param AbsencePlanUuid $uuid
   * @param array $users
   * @param string $entityClass
   * @return void
   */
  public function UnAssignSalaryAbsencePlan(AbsencePlanUuid $uuid, array $users, string $entityClass): void;

  /**
   * @param Select $select
   * @param Criteria $criteria
   * @return ObjectQuery
   */
  public function getMappingAssignAbsencePlan(Select $select, Criteria $criteria): ObjectQuery;

}
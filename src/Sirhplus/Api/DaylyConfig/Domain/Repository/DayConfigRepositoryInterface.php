<?php

namespace Sirhplus\Api\DaylyConfig\Domain\Repository;

use Sirhplus\Api\DaylyConfig\Domain\DayConfigNotFoundException;
use Sirhplus\Api\DaylyConfig\Domain\DayConfigUuid;
use Sirhplus\Api\DaylyConfig\Domain\Model\AddDayConfigModel;
use Sirhplus\Api\DaylyConfig\Domain\ShowDayConfigByIdResult;
use Sirhplus\Api\HourlyRegime\Domain\HourlyRegimeUuid;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Application\Select;
use Sirhplus\Shared\Domain\Query\ObjectQuery;
use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;

/**
 * interface DayConfigRepositoryInterface
 */
interface DayConfigRepositoryInterface
{
    /**
     * @param AddDayConfigModel $model
     * @return void
     */
    public function add(AddDayConfigModel $model): void;

    /**
     * @param HourlyRegimeUuid $uuid
     * @return ShowDayConfigByIdResult
     * @throws DayConfigNotFoundException
     */
    public function findById(HourlyRegimeUuid $uuid): ShowDayConfigByIdResult;

    /**
     * @param Select $select
     * @param Criteria $criteria
     * @return AbstractResultSet
     */
    public function getMapping(Select $select, Criteria $criteria): AbstractResultSet;


    /**
     * @param Select $select
     * @param Criteria $criteria
     * @return ObjectQuery
     */
    public function getMappingDayConfig(Select $select, Criteria $criteria): ObjectQuery;

}
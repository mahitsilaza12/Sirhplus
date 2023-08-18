<?php

namespace Sirhplus\Api\HourlyRegime\Domain\Repository;

use Sirhplus\Api\Company\Domain\CompanyHourlyRegimeResultSet;
use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\HourlyRegime\Domain\HourlyRegimeNotFoundException;
use Sirhplus\Api\HourlyRegime\Domain\HourlyRegimeUuid;
use Sirhplus\Api\HourlyRegime\Domain\Model\AddHourlyRegimeModel;
use Sirhplus\Api\HourlyRegime\Domain\Model\EditHourlyRegimeModel;
use Sirhplus\Api\HourlyRegime\Domain\Model\ExtraHoursModel;
use Sirhplus\Api\HourlyRegime\Domain\Model\TimeTrackersModel;
use Sirhplus\Api\HourlyRegime\Domain\ShowHourlyRegimeByIdResult;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Application\Select;
use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;
use Symfony6\Entity\HourlyRegime;

interface HourlyRegimeRepositoryInterface
{
    /**
     * @param AddHourlyRegimeModel $model
     * @return ShowHourlyRegimeByIdResult
     */
    public function add(AddHourlyRegimeModel $model): ShowHourlyRegimeByIdResult;

   
    /**
     * @param HourlyRegime $hourlyRegime
     * @param EditHourlyRegimeModel $model
     * @return void
     */
    public function edit(HourlyRegime $hourlyRegime,EditHourlyRegimeModel $model): void;

    /**
     * @param string $uuid
     * @return ShowHourlyRegimeByIdResult
     * @throws HourlyRegimeNotFoundException
     */
    public function findHourlyRegimeById(HourlyRegimeUuid $uuid): ShowHourlyRegimeByIdResult;

    /**
     * @param string $uuid
     * @return void
     * @throws HourlyRegimeNotFoundException
     */
    public function remove(HourlyRegimeUuid $uuid): void;

    /**
     * @param Select $select
     * @param Criteria $criteria
     * @return AbstractResultSet
     */
    public function getMapping(Select $select, Criteria $criteria): AbstractResultSet;

    /**
     * @param CompanyUuid $uuid
     * @return CompanyHourlyRegimeResultSet
     */
    public function findHourlyRegimeByCompanyUuid(CompanyUuid $uuid): CompanyHourlyRegimeResultSet;
    
    /**
     * @param HourlyRegime $hourlyRegime
     * @param ExtraHoursModel $model
     * @return void
     */
    public function editExtraHours(HourlyRegime $hourlyRegime,ExtraHoursModel $model): void;

    /**
     * @param HourlyRegime $hourlyRegime
     * @param TimeTrackersModel $model
     * @return void
     */
    public function editTimeTrackers(HourlyRegime $hourlyRegime,TimeTrackersModel $model): void;

}
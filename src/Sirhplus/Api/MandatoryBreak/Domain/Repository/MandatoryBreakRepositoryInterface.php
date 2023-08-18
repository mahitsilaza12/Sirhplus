<?php

namespace Sirhplus\Api\MandatoryBreak\Domain\Repository;

use Sirhplus\Api\HourlyRegime\Domain\HourlyRegimeUuid;
use Sirhplus\Api\MandatoryBreak\Domain\MandatoryBreakNotFoundException;
use Sirhplus\Api\MandatoryBreak\Domain\Model\AddMandatoryBreakModel;
use Sirhplus\Api\MandatoryBreak\Domain\Model\EditMandatoryBreakModel;
use Sirhplus\Api\MandatoryBreak\Domain\ShowMandatoryBreakByIdResult;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Application\Select;
use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;
use Symfony6\Entity\MandatoryBreak;

/**
 * interface MandatoryBreakRepositoryInterface
 */
interface MandatoryBreakRepositoryInterface
{
    /**
     * @param AddMandatoryBreakModel $model
     * @return void
     */
    public function add(AddMandatoryBreakModel $model): void;

    /**
     * @param string $uuid
     * @return ShowMandatoryBreakByIdResult
     * @throws MandatoryBreakNotFoundException
     */
    public function findMandatoryBreakById(HourlyRegimeUuid $uuid): ShowMandatoryBreakByIdResult;

    /**
     * @param MandatoryBreak $mandatoryBreak
     * @param EditMandatoryBreakModel $model
     * @return void
     */
    public function edit(MandatoryBreak $mandatory, EditMandatoryBreakModel $model): void;

    /**
     * @param string $uuid
     * @return void
     * @throws MandatoryBreakNotFoundException
     */
    public function remove(string $uuid): void;

    /**
     * @param Select $select
     * @param Criteria $criteria
     * @return AbstractResultSet
     */
    public function getMapping(Select $select, Criteria $criteria): AbstractResultSet;
}
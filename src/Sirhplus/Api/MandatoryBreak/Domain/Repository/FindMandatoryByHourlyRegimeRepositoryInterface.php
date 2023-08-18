<?php

namespace Sirhplus\Api\MandatoryBreak\Domain\Repository;

use Sirhplus\Api\MandatoryBreak\Domain\MandatoryBreakResultSet;

/**
 * interface FindMandatoryByHourlyRegimeRepositoryInterface
 */
interface FindMandatoryByHourlyRegimeRepositoryInterface
{
    /**
     * @param integer $id
     * @return MandatoryBreakResultSet
     */
    public function findMandatoryByHourlyRegime(int $id): MandatoryBreakResultSet;
}
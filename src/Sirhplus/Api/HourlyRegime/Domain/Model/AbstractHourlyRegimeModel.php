<?php

namespace Sirhplus\Api\HourlyRegime\Domain\Model;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

abstract class AbstractHourlyRegimeModel extends ValueObject implements Request
{
  /**
   * @param AdditionalHourModel $additionalHour
   */
    public function __construct(
      private AdditionalHourModel $additionalHour,
    ) {
    }

     /**
     * @param Request $request
     * @return AbstractHourlyRegimeModel
     */
    public abstract static function create(Request $request) :AbstractHourlyRegimeModel;

    /**
     * @return AdditionalHourModel
     */
    public function additionalHour(): AdditionalHourModel
    {
        return $this->additionalHour;
    }
}
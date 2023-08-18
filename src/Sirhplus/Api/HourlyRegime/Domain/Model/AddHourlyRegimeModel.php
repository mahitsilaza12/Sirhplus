<?php

namespace Sirhplus\Api\HourlyRegime\Domain\Model;

use Sirhplus\Shared\Service\Request;

final class AddHourlyRegimeModel extends AbstractHourlyRegimeModel
{
    /**
     * @param AdditionalHourModel $additionalHour
     */
    public function __construct(
         AdditionalHourModel $additionalHour,
      ) {
        parent::__construct($additionalHour);
      }

    /**
     * @param Request $request
     * @return AddHourlyRegimeModel
     */
    public static function create(Request $request) :AddHourlyRegimeModel
    {
        return new self(
            AdditionalHourModel::create($request->additionalHour),
        );
    }
}
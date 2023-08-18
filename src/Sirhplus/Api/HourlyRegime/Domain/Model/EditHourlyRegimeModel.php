<?php

namespace Sirhplus\Api\HourlyRegime\Domain\Model;

use Sirhplus\Shared\Service\Request;

final class EditHourlyRegimeModel extends AbstractHourlyRegimeModel
{
    /**
     * @param AdditionalHourModel $additionalHour
     */
    public function __construct(
        private AdditionalHourModel $additionalHour,
      ) {
        parent::__construct($additionalHour);
      }

    /**
     * @param Request $request
     * @return EditHourlyRegimeModel
     */
    public static function create(Request $request) :EditHourlyRegimeModel
    {
        return new self(
            AdditionalHourModel::create($request->additionalHour),
        );
    }
}
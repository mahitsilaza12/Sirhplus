<?php

namespace Sirhplus\Api\HourlyRegime\Application\AddHourlyRegime;

use Sirhplus\Api\HourlyRegime\Application\AbstractHourlyRegimeRequest;
use Sirhplus\Api\HourlyRegime\Application\HourlyRegimeRequest\AdditionalHourRequest;
use Symfony\Component\Validator\Constraints\Collection;

final class AddHourlyRegimeRequest extends AbstractHourlyRegimeRequest
{

    /**
     * @param AdditionalHourRequest $additionalHour
     */
    public function __construct(
        public AdditionalHourRequest $additionalHour
      ) {
        parent::__construct($additionalHour);
      }
}
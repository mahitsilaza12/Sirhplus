<?php

namespace Sirhplus\Api\HourlyRegime\Application\EditHourlyRegime;

use Sirhplus\Api\HourlyRegime\Application\AbstractHourlyRegimeRequest;
use Sirhplus\Api\HourlyRegime\Application\HourlyRegimeRequest\AdditionalHourRequest;

final class EditHourlyRegimeRequest extends AbstractHourlyRegimeRequest
{
    private string $uuid;
    /**
     * @param AdditionalHourRequest $additionalHour
     */
    public function __construct(
        public AdditionalHourRequest $additionalHour,
      ) {
        parent::__construct($additionalHour);
      }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     * @return EditHourlyRegimeRequest
     */
    public function setId(string $uuid): EditHourlyRegimeRequest
    {
        $this->uuid = $uuid;

        return $this;
    }
}
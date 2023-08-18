<?php

namespace Sirhplus\Api\HourlyRegime\Application\ExtraHours;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

final class ExtraHoursRequest extends ValueObject implements Request
{
  private string $uuid;
  /**
   * @param boolean $accountAdditionalHour
   * @param string $frequency
   */
  public function __construct(
    public bool $accountAdditionalHour = false,
    public string $frequency = '',
) {
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
     * @return ExtraHoursRequest
     */
    public function setId(string $uuid): ExtraHoursRequest
    {
        $this->uuid = $uuid;

        return $this;
    }
}
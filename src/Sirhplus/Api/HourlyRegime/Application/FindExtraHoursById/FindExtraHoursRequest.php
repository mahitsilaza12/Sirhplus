<?php

namespace Sirhplus\Api\HourlyRegime\Application\FindExtraHoursById;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

/**
 * class FindExtraHoursRequest
 */
final class FindExtraHoursRequest extends ValueObject implements Request
{
    /**
     * @param string $uuid
     */
    public function __construct(public string $uuid = '')
    {
    }

    /**
     * @param string $uuid
     * @return FindExtraHoursRequest
     */
    public function setId(string $uuid): FindExtraHoursRequest
    {
        $this->uuid = $uuid;

        return $this;
    }
}
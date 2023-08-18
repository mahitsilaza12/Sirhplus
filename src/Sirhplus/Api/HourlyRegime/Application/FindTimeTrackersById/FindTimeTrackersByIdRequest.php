<?php

namespace Sirhplus\Api\HourlyRegime\Application\FindTimeTrackersById;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

/**
 * class FindTimeTrackersByIdRequest
 */
final class FindTimeTrackersByIdRequest extends ValueObject implements Request
{
    /**
     * @param string $uuid
     */
    public function __construct(public string $uuid = '')
    {
    }

    /**
     * @param string $uuid
     * @return FindTimeTrackersByIdRequest
     */
    public function setId(string $uuid): FindTimeTrackersByIdRequest
    {
        $this->uuid = $uuid;

        return $this;
    }
}
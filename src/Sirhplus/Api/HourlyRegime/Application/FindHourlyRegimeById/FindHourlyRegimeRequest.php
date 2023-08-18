<?php

namespace Sirhplus\Api\HourlyRegime\Application\FindHourlyRegimeById;

use Sirhplus\Shared\Service\Request;

/**
 * class FindHourlyRegimeRequest
 */
final class FindHourlyRegimeRequest implements Request
{
    /**
     * @param string $uuid
     */
    public function __construct(public string $uuid = '')
    {
    }

    /**
     * @param string $uuid
     * @return FindHourlyRegimeRequest
     */
    public function setId(string $uuid): FindHourlyRegimeRequest
    {
        $this->uuid = $uuid;

        return $this;
    }
}
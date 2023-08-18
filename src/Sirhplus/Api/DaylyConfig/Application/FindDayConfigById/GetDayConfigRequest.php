<?php

namespace Sirhplus\Api\DaylyConfig\Application\FindDayConfigById;

use Sirhplus\Shared\Service\Request;

/**
 * class GetDayConfigRequest
 */
final class GetDayConfigRequest implements Request
{
    /**
     * @param string $uuid
     */
    public function __construct(public string $uuid = '')
    {
    }

    /**
     * @param string $uuid
     * @return GetDayConfigRequest
     */
    public function setid(string $uuid): GetDayConfigRequest
    {
        $this->$uuid = $uuid;

        return $this;
    }
}
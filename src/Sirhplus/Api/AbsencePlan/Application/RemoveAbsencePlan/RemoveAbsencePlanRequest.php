<?php

namespace Sirhplus\Api\AbsencePlan\Application\RemoveAbsencePlan;

use Sirhplus\Shared\Service\Request;

/**
 * class RemoveAbsencePlanRequest
 */
final class RemoveAbsencePlanRequest implements Request
{
     /**
     * @param string $uuid
     */
    public function __construct(public string $uuid = '')
    {
    }

    /**
     * @param string $uuid
     * @return RemoveAbsencePlanRequest
     */
    public function setId(string $uuid) :RemoveAbsencePlanRequest
    {
        $this->uuid = $uuid;

        return $this; 
    }
}
<?php

namespace Sirhplus\Api\AbsencePlan\Application\FindAbsencePlanById;

use Sirhplus\Shared\Service\Request;

/**
 * class FindAbsencePlanByIdRequest
 */
final class FindAbsencePlanByIdRequest implements Request
{
     /**
     * @param string $uuid
     */
    public function __construct(public string $uuid = '')
    {
    }

    /**
     * @param string $uuid
     * @return FindAbsencePlanByIdRequest
     */
    public function setId(string $uuid) :FindAbsencePlanByIdRequest
    {
        $this->uuid = $uuid;

        return $this; 
    }
}
<?php

namespace Sirhplus\Api\Salary\Application\FindSalaryById;

use Sirhplus\Shared\Service\Request;

final class FindSalaryByIdRequest implements Request
{
    /**
     * @param string $uuid
     */
    public function __construct(public string $uuid = '')
    {
    }

    /**
     * @param string $uuid
     * @return FindSalaryByIdRequest
     */
    public function setUuid(string $uuid) :FindSalaryByIdRequest
    {
        $this->uuid = $uuid;
        
        return $this;
    }
}

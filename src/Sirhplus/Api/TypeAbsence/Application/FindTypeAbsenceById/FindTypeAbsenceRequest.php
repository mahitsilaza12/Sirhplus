<?php

namespace Sirhplus\Api\TypeAbsence\Application\FindTypeAbsenceById;

use Sirhplus\Shared\Service\Request;

final class FindTypeAbsenceRequest implements Request
{
    /**
     * @param string $uuid
     */
    public function __construct(public string $uuid = '')
    {
    }

    public function setId(string $uuid) :FindTypeAbsenceRequest
    {
        $this->uuid = $uuid;

        return $this; 
    }
}
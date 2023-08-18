<?php

namespace Sirhplus\Api\TypeAbsence\Application\RemoveTypeAbsence;

use Sirhplus\Shared\Service\Request;

final class RemoveTypeAbsenceRequest implements Request
{
    /**
     * @param string $uuid
     */
    public function __construct(public string $uuid = '')
    {
    }

    /**
     * @param string $uuid
     * @return RemoveTypeAbsenceRequest
     */
    public function setId(string $uuid) :RemoveTypeAbsenceRequest
    {
        $this->uuid = $uuid;

        return $this; 
    }
}
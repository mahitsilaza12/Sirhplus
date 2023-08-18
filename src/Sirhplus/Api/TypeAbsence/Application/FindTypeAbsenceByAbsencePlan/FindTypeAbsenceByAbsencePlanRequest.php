<?php

namespace Sirhplus\Api\TypeAbsence\Application\FindTypeAbsenceByAbsencePlan;

use Sirhplus\Shared\Service\Request;

/**
 * class FindTypeAbsenceByAbsencePlanRequest
 */
final class FindTypeAbsenceByAbsencePlanRequest implements Request
{
    public string $absenceUuid;
    public string $uuid;
    /**
     * @param string $uuid
     */
    public function __construct()
    {
    }

    /**
     * @param string $uuid
     */
    public function setId(string $uuid) :self
    {
        $this->uuid = $uuid;

        return $this; 
    }

    /**
     * @param string $absenceUuid
     * @return self
     */
    public function setType(string $absenceUuid): self
    {
        $this->absenceUuid = $absenceUuid;

        return $this;
    }
}
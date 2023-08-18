<?php

namespace Sirhplus\Api\TypeAbsence\Application\AssignAbsencePlanType;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

/**
 * class AssignAbsencePlanTypeRequest
 */
final class AssignAbsencePlanTypeRequest extends ValueObject implements Request
{

    /**
     * @param string $uuid
     * @param string $absencePlanId
     */
    public function __construct(public string $uuid = '', public string $absencePlanId = '')
    {
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     * @return self
     */
    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }
}
<?php

namespace Sirhplus\Api\TypeAbsence\Application\UnassignedAbsencePlanType;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

/**
 * class UnassignedAbsencePlanTypeRequest
 */
final class UnassignedAbsencePlanTypeRequest extends ValueObject implements Request
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
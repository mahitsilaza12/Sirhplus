<?php

namespace Sirhplus\Api\Salary\Application\FindSalaryByAbsencePlan;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

/**
 * class FindSalaryByAbsencePlanRequest
 */
final class FindSalaryByAbsencePlanRequest extends ValueObject implements Request
{
    /**
     * @param string $uuid
     */
    public function __construct(public string $uuid = '')
    {
    }

    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }
}
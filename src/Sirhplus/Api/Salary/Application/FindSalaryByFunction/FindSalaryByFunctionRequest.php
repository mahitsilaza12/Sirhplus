<?php

namespace Sirhplus\Api\Salary\Application\FindSalaryByFunction;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

/**
 * class FindSalaryByFunctionRequest
 */
final class FindSalaryByFunctionRequest extends ValueObject implements Request
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

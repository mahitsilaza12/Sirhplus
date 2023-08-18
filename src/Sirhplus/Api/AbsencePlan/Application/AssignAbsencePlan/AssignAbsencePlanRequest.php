<?php

namespace Sirhplus\Api\AbsencePlan\Application\AssignAbsencePlan;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

/**
 * class AssignAbsencePlanRequest
 */
final class AssignAbsencePlanRequest extends ValueObject implements Request
{

    /**
     * @param array $salaries
     * @param string $uuid
     */
    public function __construct(public array|null $salaries = [], public string $uuid = '')
    {
        
    }

      /**
     * @param string $uuid
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

       /**
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }
}
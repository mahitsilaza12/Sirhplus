<?php

namespace Sirhplus\Api\AbsencePlan\Application\UnAssignedAbsencePlan;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

final class UnAssignedAbsencePlanRequest extends ValueObject implements Request
{
    /**
     * @param array $users
     * @param string $uuid
     */
    public function __construct(public array|null $users = [], public string $uuid = '')
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
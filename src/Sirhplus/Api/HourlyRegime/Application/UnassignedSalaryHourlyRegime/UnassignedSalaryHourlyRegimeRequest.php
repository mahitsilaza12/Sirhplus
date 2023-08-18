<?php

namespace Sirhplus\Api\HourlyRegime\Application\UnassignedSalaryHourlyRegime;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

/**
 * class UnassignedSalaryHourlyRegimeRequest
 */
final class UnassignedSalaryHourlyRegimeRequest extends ValueObject implements Request
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
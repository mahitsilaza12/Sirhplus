<?php

namespace Sirhplus\Api\Salary\Application\FindSalaryByTeam;

use Sirhplus\Shared\Service\Request;

final class FindSalaryByTeamRequest implements Request
{
    public function __construct(private string $uuid = '')
    {
    }

    /**
     * @return string
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

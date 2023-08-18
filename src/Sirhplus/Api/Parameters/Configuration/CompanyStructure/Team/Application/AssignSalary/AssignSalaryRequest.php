<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\AssignSalary;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

final class AssignSalaryRequest extends ValueObject implements Request
{
    /**
     * @param array|null $salaries
     * @param string $teamUuid
     */
    public function __construct(public array|null $salaries = [], public string $teamUuid = '')
    {
    }

    /**
     * @param string $teamUuid
     */
    public function setTeamUuid(string $teamUuid): void
    {
        $this->teamUuid = $teamUuid;
    }
}

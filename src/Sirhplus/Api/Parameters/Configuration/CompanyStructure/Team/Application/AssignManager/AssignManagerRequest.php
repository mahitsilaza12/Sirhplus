<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\AssignManager;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

final class AssignManagerRequest extends ValueObject implements Request
{
    public function __construct(public array|null $users = [], public string $teamUuid = '')
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

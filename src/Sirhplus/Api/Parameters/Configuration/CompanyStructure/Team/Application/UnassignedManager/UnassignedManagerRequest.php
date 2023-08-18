<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\UnassignedManager;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

final class UnassignedManagerRequest extends ValueObject implements Request
{
    public string $teamUuid;

    public function __construct(public string $userUuid = '')
    {
        $this->teamUuid = '';
    }

    /**
     * @param string $teamUuid
     */
    public function setTeamUuid(string $teamUuid): void
    {
        $this->teamUuid = $teamUuid;
    }

    /**
     * @param string $userUuid
     */
    public function setUserUuid(string $userUuid): void
    {
        $this->userUuid = $userUuid;
    }
}

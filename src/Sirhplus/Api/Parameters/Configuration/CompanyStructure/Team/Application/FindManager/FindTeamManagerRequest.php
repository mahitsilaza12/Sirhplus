<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\FindManager;

use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\TeamRequest;

final class FindTeamManagerRequest extends TeamRequest
{
    /**
     * @param string $uuid
     */
    public function __construct(public string $uuid = '')
    {
        parent::__construct($uuid);
    }
}

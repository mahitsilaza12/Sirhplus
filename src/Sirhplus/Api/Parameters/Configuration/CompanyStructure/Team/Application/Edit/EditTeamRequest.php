<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\Edit;

use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\TeamRequest;

final class EditTeamRequest extends TeamRequest
{
    /**
     * @param string $name
     */
    public function __construct(public string $name = '')
    {
        parent::__construct('', '', $name);
    }
}

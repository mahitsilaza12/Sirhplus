<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\Create;

use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\TeamRequest;

/**
 * class CreateTeamRequest
 */
final class CreateTeamRequest extends TeamRequest
{
    /**
     * @param string $companyUuid
     * @param string $name
     */
    public function __construct(public string $companyUuid = '', public string $name = '')
    {
        parent::__construct('', $companyUuid, $name);
    }
}

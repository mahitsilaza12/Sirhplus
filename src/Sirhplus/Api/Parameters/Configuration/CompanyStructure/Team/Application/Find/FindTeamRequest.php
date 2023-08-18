<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\Find;

use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\TeamRequest;

/**
 * class FindTeamRequest
 */
final class FindTeamRequest extends TeamRequest
{
    /**
     * @param string $uuid
     */
    public function __construct(public string $uuid = '')
    {
        parent::__construct($uuid);
    }
}

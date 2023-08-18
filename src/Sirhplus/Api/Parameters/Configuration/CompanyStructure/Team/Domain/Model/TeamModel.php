<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\Model;

use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Shared\Service\Request;

abstract class TeamModel
{
    /**
     * @param CompanyUuid|null $companyUuid = null
     * @param string $name
     * @param string $uuid
     */
    public function __construct(public CompanyUuid|null $companyUuid = null, public string $name = '', public string $uuid = '')
    {
    }

    /**
     * @param Request $request
     * @return TeamModel
     */
    public abstract static function create(Request $request): TeamModel;
}

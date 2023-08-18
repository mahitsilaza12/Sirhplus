<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\Model;

use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Shared\Service\Request;

/**
 * class CreateTeamModel
 */
final class CreateTeamModel extends TeamModel
{
    /**
     * @param CompanyUuid|null $companyUuid = null
     * @param string $name
     */
    public function __construct(public CompanyUuid|null $companyUuid = null, public string $name = '')
    {
        parent::__construct($companyUuid, $this->name);
    }

    /**
     * @param Request $request
     * @return TeamModel
     */
    public static function create(Request $request): TeamModel
    {
        return new self(CompanyUuid::fromString($request->companyUuid), $request->name);
    }
}

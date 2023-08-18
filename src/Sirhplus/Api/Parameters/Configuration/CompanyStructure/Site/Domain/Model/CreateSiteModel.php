<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain\Model;

use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Shared\Service\Request;

/**
 * class CreateSiteModel
 */
final class CreateSiteModel extends SiteModel
{
    /**
     * @param CompanyUuid|null $companyUuid
     * @param string $name
     */
    public function __construct(public CompanyUuid|null $companyUuid = null, public string $name = '')
    {
        parent::__construct(null, $companyUuid, $this->name);
    }

    /**
     * @param Request $request
     * @return SiteModel
     */
    public static function create(Request $request): SiteModel
    {
        return new self(CompanyUuid::fromString($request->companyUuid), $request->name);
    }
}

<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Application\Create;

use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Application\SiteRequest;

/**
 * class CreateSiteRequest
 */
final class CreateSiteRequest extends SiteRequest
{
    /**
     * @param string $companyUuid
     * @param string $name
     */
    public function __construct(public string $companyUuid = '', public string $name = '')
    {
        parent::__construct(0, $companyUuid, $name);
    }
}

<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain\Model;

use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain\SiteUuid;
use Sirhplus\Shared\Service\Request;

/**
 * class SiteModel
 */
abstract class SiteModel
{
    /**
     * @param SiteUuid|null $uuid
     * @param CompanyUuid|null $companyUuid
     * @param string $name
     */
    public function __construct(
        public SiteUuid|null $uuid = null,
        public CompanyUuid|null $companyUuid = null,
        public string $name = ''
    ) {
    }

    /**
     * @param Request $request
     * @return SiteModel
     */
    public abstract static function create(Request $request): SiteModel;
}

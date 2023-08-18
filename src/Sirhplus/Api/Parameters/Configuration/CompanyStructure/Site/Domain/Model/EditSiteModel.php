<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain\Model;

use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain\SiteUuid;
use Sirhplus\Shared\Service\Request;

/**
 * class EditSiteModel
 */
final class EditSiteModel extends SiteModel
{
    /**
     * @param SiteUuid|null $uuid
     * @param string $name
     */
    public function __construct(public SiteUuid|null $uuid = null, public string $name = '')
    {
        parent::__construct($uuid, null, $this->name);
    }

    /**
     * @param Request $request
     * @return SiteModel
     */
    public static function create(Request $request): SiteModel
    {
        return new self(SiteUuid::fromString($request->uuid), $request->name);
    }
}


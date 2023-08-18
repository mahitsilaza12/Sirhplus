<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Application\Find;

use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Application\SiteRequest;

/**
 * class FindSiteRequest
 */
final class FindSiteRequest extends SiteRequest
{
    /**
     * @param string $uuid
     */
    public function __construct(public string $uuid = '')
    {
        parent::__construct($uuid);
    }
}

<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Application\Remove;

use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Application\SiteRequest;

final class RemoveSiteRequest extends SiteRequest
{
    /**
     * @param string $uuid
     */
    public function __construct(public string $uuid = '')
    {
        parent::__construct($uuid);
    }
}

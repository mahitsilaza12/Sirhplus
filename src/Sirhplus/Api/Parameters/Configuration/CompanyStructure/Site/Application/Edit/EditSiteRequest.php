<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Application\Edit;

use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Application\SiteRequest;

/**
 * class EditSiteRequest
 */
final class EditSiteRequest extends SiteRequest
{
    /**
     * @param string $name
     */
    public function __construct(public string $name = '')
    {
        parent::__construct('', 0, $name);
    }
}

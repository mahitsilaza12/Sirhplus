<?php

namespace Symfony6\Controller\Company\GetSitesCompany;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony6\Request\AbstractInputDataRequest;

/**
 * class GetSiteCompanyRequest
 */
final class GetSiteCompanyRequest extends AbstractInputDataRequest
{
    /**
     * @param RequestStack $request
     * @param string $uuid
     */
    public function __construct(RequestStack $request, public string $uuid = '')
    {
        parent::__construct($request);
    }

    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }
}

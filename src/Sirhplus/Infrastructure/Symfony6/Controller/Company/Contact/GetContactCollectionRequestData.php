<?php

namespace Symfony6\Controller\Company\Contact;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony6\Request\AbstractInputDataRequest;

/**
 * class GetContactCollectionRequestData
 */
final class GetContactCollectionRequestData extends AbstractInputDataRequest
{
    /**
     * @param RequestStack $request
     */
    public function __construct(RequestStack $request, public string $companyUuid = '')
    {
        parent::__construct($request);
    }

    /**
     * @param string $companyUuid
     */
    public function setCompanyUuid(string $companyUuid): void
    {
        $this->companyUuid = $companyUuid;
    }
}

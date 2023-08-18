<?php

namespace Symfony6\Controller\Company\Collections;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony6\Request\AbstractInputDataRequest;

/**
 * class CompanyGetCollectionRequestData
 */
final class CompanyGetCollectionRequestData extends AbstractInputDataRequest
{
    /**
     * @param RequestStack $request
     */
    public function __construct(RequestStack $request)
    {
        parent::__construct($request);
    }
}

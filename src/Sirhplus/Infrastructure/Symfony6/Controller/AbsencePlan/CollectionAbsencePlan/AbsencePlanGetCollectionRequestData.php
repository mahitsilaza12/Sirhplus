<?php

namespace Symfony6\Controller\AbsencePlan\CollectionAbsencePlan;

use Symfony6\Request\AbstractInputDataRequest;
use Symfony\Component\HttpFoundation\RequestStack;

final class AbsencePlanGetCollectionRequestData extends AbstractInputDataRequest
{
     /**
     * @param RequestStack $request
     */
    public function __construct(RequestStack $request)
    {
        parent::__construct($request);
    }
}
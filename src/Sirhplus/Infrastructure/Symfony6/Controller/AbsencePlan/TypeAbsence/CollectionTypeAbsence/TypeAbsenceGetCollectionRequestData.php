<?php

namespace Symfony6\Controller\AbsencePlan\TypeAbsence\CollectionTypeAbsence;

use Symfony6\Request\AbstractInputDataRequest;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * class TypeAbsenceGetCollectionRequestData
 */
final class TypeAbsenceGetCollectionRequestData extends AbstractInputDataRequest
{
     /**
     * @param RequestStack $request
     */
    public function __construct(RequestStack $request)
    {
        parent::__construct($request);
    }
}
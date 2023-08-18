<?php

namespace Symfony6\Controller\AbsencePlan\CollectionAssignSalaryAbsencePlan;

use Symfony6\Request\AbstractInputDataRequest;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * class CollectionAssignSalaryAbsencePlanRequestData
 */
final class CollectionAssignSalaryAbsencePlanRequestData extends AbstractInputDataRequest
{
     /**
     * @param RequestStack $request
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
<?php

namespace Symfony6\Controller\HourlyRegime\CollectionAssignedSalaryByHourlyRegime;

use Symfony6\Request\AbstractInputDataRequest;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * class FindAllAssignedSalaryByHourlyRegimeRequestData
 */
final class FindAllAssignedSalaryByHourlyRegimeRequestData extends AbstractInputDataRequest
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
<?php

namespace Symfony6\Controller\HourlyRegime\DayConfig\FindAllDayConfig;

use Symfony6\Request\AbstractInputDataRequest;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * class FindAllDayConfigRequestData
 */
final class FindAllDayConfigRequestData extends AbstractInputDataRequest
{
    /**
     * @param RequestStack $request
     */
    public function __construct(RequestStack $request)
    {
        parent::__construct($request);
    }
}
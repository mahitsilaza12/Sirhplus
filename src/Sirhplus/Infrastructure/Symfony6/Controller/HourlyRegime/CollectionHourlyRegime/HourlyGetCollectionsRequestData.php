<?php

namespace Symfony6\Controller\HourlyRegime\CollectionHourlyRegime;

use Symfony6\Request\AbstractInputDataRequest;
use Symfony\Component\HttpFoundation\RequestStack;

final class HourlyGetCollectionsRequestData extends AbstractInputDataRequest
{
    /**
     * @param RequestStack $request
     */
    public function __construct(RequestStack $request)
    {
        parent::__construct($request);
    }
}
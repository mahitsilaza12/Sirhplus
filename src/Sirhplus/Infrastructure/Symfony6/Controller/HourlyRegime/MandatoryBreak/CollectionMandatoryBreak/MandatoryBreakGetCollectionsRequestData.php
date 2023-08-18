<?php

namespace Symfony6\Controller\HourlyRegime\MandatoryBreak\CollectionMandatoryBreak;


use Symfony6\Request\AbstractInputDataRequest;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * class MandatoryBreakGetCollectionsRequestData
 */
final class MandatoryBreakGetCollectionsRequestData extends AbstractInputDataRequest
{
    /**
     * @param RequestStack $request
     */
    public function __construct(RequestStack $request)
    {
        parent::__construct($request);
    }
}
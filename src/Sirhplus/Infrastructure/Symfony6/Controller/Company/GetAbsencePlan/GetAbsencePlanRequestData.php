<?php

namespace Symfony6\Controller\Company\GetAbsencePlan;

use Symfony6\Request\AbstractInputDataRequest;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * class GetAbsencePlanRequestData
 */
final class GetAbsencePlanRequestData extends AbstractInputDataRequest
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
     *
     * @return GetTeamsCollectionRequestData
     */
    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }
}
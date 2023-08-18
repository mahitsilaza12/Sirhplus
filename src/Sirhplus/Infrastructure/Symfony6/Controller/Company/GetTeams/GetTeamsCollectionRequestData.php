<?php

namespace Symfony6\Controller\Company\GetTeams;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony6\Request\AbstractInputDataRequest;

/**
 * class GetTeamsCollectionRequestData
 */
final class GetTeamsCollectionRequestData extends AbstractInputDataRequest
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

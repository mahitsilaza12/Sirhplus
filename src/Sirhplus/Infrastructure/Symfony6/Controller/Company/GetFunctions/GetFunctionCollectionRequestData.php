<?php

namespace Symfony6\Controller\Company\GetFunctions;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony6\Request\AbstractInputDataRequest;

/**
 * class GetFunctionCollectionRequestData
 */
final class GetFunctionCollectionRequestData extends AbstractInputDataRequest
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
     * @return GetFunctionCollectionRequestData
     */
    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }
}

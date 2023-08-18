<?php

namespace Symfony6\Controller\Company\GetManagers;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony6\Request\AbstractInputDataRequest;

final class GetManagerCollectionRequestData extends AbstractInputDataRequest
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
     * @return GetManagerCollectionRequestData
     */
    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }
}

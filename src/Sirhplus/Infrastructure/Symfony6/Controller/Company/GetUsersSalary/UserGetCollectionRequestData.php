<?php

namespace Symfony6\Controller\Company\GetUsersSalary;

use Symfony6\Request\AbstractInputDataRequest;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * class UserGetCollectionRequestData
 */
final class UserGetCollectionRequestData extends AbstractInputDataRequest
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
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }
}

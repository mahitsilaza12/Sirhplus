<?php

namespace Sirhplus\Api\Company\Application\CompanySubscriber;

use Sirhplus\Shared\Service\Request;

/**
 * class CompanySubscriberRequest
 */
final class CompanySubscriberRequest implements Request
{
    /**
     * @param string $subscriptionUuid
     * @param string $uuid
     */
    public function __construct(public string $subscriptionUuid = '', public string $uuid = '')
    {
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     * @return CompanySubscriberRequest
     */
    public function setUuid(string $uuid) :CompanySubscriberRequest
    {
        $this->uuid = $uuid;

        return $this;
    }
}

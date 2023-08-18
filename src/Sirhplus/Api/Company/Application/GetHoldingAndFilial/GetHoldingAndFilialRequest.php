<?php

namespace Sirhplus\Api\Company\Application\GetHoldingAndFilial;

use Sirhplus\Shared\Service\Request;

/**
 * class GetHoldingAndFilialRequest
 */
final class GetHoldingAndFilialRequest implements Request
{
    /**
     * @param string $uuid
     */
    public function __construct(public string $uuid = '')
    {
    }

    /**
     * @param string $uuid
     * @return GetHoldingAndFilialRequest
     */
    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }
}

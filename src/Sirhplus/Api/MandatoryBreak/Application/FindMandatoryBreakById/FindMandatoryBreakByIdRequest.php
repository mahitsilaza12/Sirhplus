<?php

namespace Sirhplus\Api\MandatoryBreak\Application\FindMandatoryBreakById;

use Sirhplus\Shared\Service\Request;

/**
 * class FindMandatoryBreakByIdRequest
 */
final class FindMandatoryBreakByIdRequest implements Request
{
    /**
     * @param string $uuid
     */
    public function __construct(public string $uuid = '')
    {
    }

    /**
     * @param string $uuid
     * @return FindMandatoryBreakByIdRequest
     */
    public function setId(string $uuid): FindMandatoryBreakByIdRequest
    {
        $this->uuid = $uuid;

        return $this;
    }
}
<?php

namespace Sirhplus\Api\MandatoryBreak\Application\RemoveMandatoryBreak;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

/**
 * class RemoveMandatoryBreakRequest
 */
final class RemoveMandatoryBreakRequest extends ValueObject implements Request
{
     /**
     * @param string $uuid
     */
    public function __construct(public string $uuid = '')
    {
    }

    /**
     * @param string $uuid
     * @return self
     */
    public function setId(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }
}
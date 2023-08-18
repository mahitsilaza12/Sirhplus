<?php

namespace Sirhplus\Api\Functions\Application\RemoveFunction;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

/**
 * class RemoveFunctionRequest
 */
final class RemoveFunctionRequest extends ValueObject implements Request
{
    /**
     * @param string $uuid
     */
    public function __construct(public string $uuid = '')
    {
    }

    /**
     * @param string $uuid
     * @return $this
     */
    public function setId(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }
}

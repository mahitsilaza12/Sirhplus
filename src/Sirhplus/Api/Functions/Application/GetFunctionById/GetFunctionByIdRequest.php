<?php

namespace Sirhplus\Api\Functions\Application\GetFunctionById;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

/**
 * class GetFunctionByIdRequest
 */
final class GetFunctionByIdRequest extends ValueObject implements Request
{
    /**
     * @param string $uuid
     */
    public function __construct(public string $uuid = '')
    {
    }

    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }
}

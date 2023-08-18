<?php

namespace Sirhplus\Api\User\Application\GetAdministrators;

use Sirhplus\Shared\Service\Request;

/**
 * class GetAdministratorRequest
 */
final class GetAdministratorRequest implements Request
{
    public function __construct(private string $uuid = '')
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
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }
}

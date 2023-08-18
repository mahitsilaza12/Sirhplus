<?php

namespace Sirhplus\Api\Company\Application\AddNewOwner;

use Sirhplus\Shared\Service\Request;

final class AddNewOwnerRequest implements Request
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

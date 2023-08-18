<?php

namespace Sirhplus\Api\Company\Application\AssignProperty;

use Sirhplus\Shared\Service\Request;

/**
 * class AssignPropertyRequest
 */
final class AssignPropertyRequest implements Request
{
    /**
     * @param string $uuid
     * @param string $userUuid
     */
    public function __construct(public string $uuid = '', public string $userUuid = '')
    {
    }

    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * @param string $userUuid
     */
    public function setUserUuid(string $userUuid): void
    {
        $this->userUuid = $userUuid;
    }
}

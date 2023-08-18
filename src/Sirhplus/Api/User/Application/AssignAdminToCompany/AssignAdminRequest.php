<?php

namespace Sirhplus\Api\User\Application\AssignAdminToCompany;

use Sirhplus\Shared\Service\Request;

/**
 * class AssignAdminRequest
 */
final class AssignAdminRequest implements Request
{
    /**
     * @param string $uuid
     * @param array|null $users
     */
    public function __construct(public string $uuid = '', public array|null $users = [])
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

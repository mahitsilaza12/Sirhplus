<?php

namespace Sirhplus\Shared\Service;

use Sirhplus\Shared\Domain\Exception\UnauthorizedException;

/**
 *
 */
interface RoleManagerInterface
{
    public const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';
    public const ROLE_OWNER = 'ROLE_OWNER';
    public const ROLE_ADMIN = 'ROLE_ADMIN';
    public const ROLE_TEAM_RESPONSIBILITY = 'ROLE_TEAM_RESPONSIBILITY';
    public const ROLE_USER = 'ROLE_USER';

    /**
     * @param array $roles
     * @throws UnauthorizedException
     * @return bool
     */
    public function hasAccessRight(array $roles): bool;
}

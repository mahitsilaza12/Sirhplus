<?php

namespace Sirhplus\Shared\Infrastructure\Role;

use Sirhplus\Shared\Domain\Exception\UnauthorizedException;
use Sirhplus\Shared\Service\GetCurrentUserInterface;
use Sirhplus\Shared\Service\RoleManagerInterface;

/**
 * class RoleManager
 */
final class RoleManager implements RoleManagerInterface
{
    /**
     * @param GetCurrentUserInterface $service
     */
    public function __construct(private readonly GetCurrentUserInterface $service)
    {
    }

    /**
     * @param array $roles
     * @throws UnauthorizedException
     * @return bool
     */
    public function hasAccessRight(array $roles): bool
    {
        // TODO: Implement hasAccessRight() method.
        if ($user = $this->service->getCurrentUser()) {
            $role = $user->getRoles();
            $role = reset($role);

            if (!in_array($role, $roles)) {
                throw new UnauthorizedException();
            }

            return true;
        }

        return false;
    }
}

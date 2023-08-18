<?php

namespace Sirhplus\Api\User\Domain\FindUserByEmail;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * interface FindUserByEmailInterface
 */
interface FindUserByEmailInterface
{
    /**
     * @param string $email
     * @return null|UserInterface
     */
    public function findUserByEmail(string $email): ?UserInterface;
}

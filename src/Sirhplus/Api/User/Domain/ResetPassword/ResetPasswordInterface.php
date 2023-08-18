<?php

namespace Sirhplus\Api\User\Domain\ResetPassword;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

interface ResetPasswordInterface
{
    /**
     * @param PasswordAuthenticatedUserInterface $user
     * @param string $password
     * @return string
     */
    public function encode(PasswordAuthenticatedUserInterface $user, string $password): string;
}

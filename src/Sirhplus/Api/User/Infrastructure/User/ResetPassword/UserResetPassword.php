<?php

namespace Sirhplus\Api\User\Infrastructure\User\ResetPassword;

use Sirhplus\Api\User\Domain\ResetPassword\ResetPasswordInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * class UserResetPassword
 *
 * @package Sirhplus\Api\User\Infrastructure\User\ResetPassword
 */
final class UserResetPassword implements ResetPasswordInterface
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {
    }

    /**
     * @param PasswordAuthenticatedUserInterface $user
     * @param string $password
     * @return string
     */
    public function encode(PasswordAuthenticatedUserInterface $user, string $password): string
    {
        return $this->hasher->hashPassword($user, $password);
    }
}

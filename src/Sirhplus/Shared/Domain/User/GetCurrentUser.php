<?php

namespace Sirhplus\Shared\Domain\User;

use Sirhplus\Shared\Service\GetCurrentUserInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

final class GetCurrentUser implements GetCurrentUserInterface
{
    /**
     * @param TokenStorageInterface $token
     */
    public function __construct(private readonly TokenStorageInterface $token)
    {
    }

    /**
     * @return object|null
     */
    public function getCurrentUser(): ?object
    {
        if ($token = $this->token->getToken()) {
            return $token->getUser();
        }

        return null;
    }
}

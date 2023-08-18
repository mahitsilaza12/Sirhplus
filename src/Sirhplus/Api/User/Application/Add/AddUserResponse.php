<?php

namespace Sirhplus\Api\User\Application\Add;

use Sirhplus\Shared\Service\Response;
use Symfony\Component\Security\Core\User\UserInterface;

final class AddUserResponse implements Response
{
    public function __construct(private readonly UserInterface $user)
    {
    }

    public function getContent(): array
    {
        return [
            'uuid' => $this->user->getId()->toRfc4122(),
        ];
    }
}

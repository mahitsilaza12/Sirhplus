<?php

namespace Sirhplus\Api\User\Application\Add;

use Sirhplus\Api\User\Domain\Repository\UserRepositoryInterface;
use Sirhplus\Api\User\Domain\UserModel;
use Symfony\Component\Security\Core\User\UserInterface;

final class AddUser implements AddUserInterface
{
    public function __construct(private readonly UserRepositoryInterface $repository)
    {
    }

    /**
     * @inheritDoc
     */
    public function add(UserModel $model): UserInterface
    {
        return $this->repository->add($model);
    }
}
